<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    // Mostrar listado de productos
    public function index()
    {
        $productos = Producto::with('reference.category')->get();
        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $references = Reference::with('category')->get();
        return view('productos.create', compact('references'));
    }

    // Almacenar nuevo producto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idItemReference' => 'required|exists:items_references,idReference',
            'serialNumberProduct' => 'nullable|string|max:255|unique:products,serialNumberProduct',
            'conditionProduct' => 'required|in:Nuevo,Usado,Dañado,Reparación,Pendiente a buscarse',
            'statusProduct' => 'required|in:Disponible,Asignado,Reservado,Desechado,Mantenimiento',
            'locationProduct' => 'required|string|max:255',
            'purchaseDateProduct' => 'nullable|date',
            'warrantyExpirationProduct' => 'nullable|date|after_or_equal:purchaseDateProduct',
            'notesProduct' => 'nullable|string',
        ]);

        $validated['createdAtProduct'] = now();
        $validated['updatedAtProduct'] = now();

        Producto::create($validated);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Producto $producto)
    {
        $references = Reference::with('category')->get();
        return view('productos.edit', compact('producto', 'references'));
    }

    // Actualizar producto
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'idItemReference' => 'required|exists:items_references,idReference',
            'serialNumberProduct' => 'nullable|string|max:255|unique:products,serialNumberProduct,'.$producto->idProduct.',idProduct',
            'conditionProduct' => 'required|in:Nuevo,Usado,Dañado,Reparación,Pendiente a buscarse',
            'statusProduct' => 'required|in:Disponible,Asignado,Reservado,Desechado,Mantenimiento',
            'locationProduct' => 'required|string|max:255',
            'purchaseDateProduct' => 'nullable|date',
            'warrantyExpirationProduct' => 'nullable|date|after_or_equal:purchaseDateProduct',
            'notesProduct' => 'nullable|string',
        ]);

        $validated['updatedAtProduct'] = now();

        $producto->update($validated);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar producto
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $file = fopen($path, 'r');

        // Leer encabezados
        $header = fgetcsv($file);

        $imported = 0;
        $errors = [];

        DB::beginTransaction();
        try {
            while (($row = fgetcsv($file)) !== false) {
                $data = array_combine($header, $row);

                $validator = Validator::make($data, [
                    'idItemReference' => 'required|exists:items_references,idReference',
                    'serialNumberProduct' => 'nullable|string|max:255|unique:products,serialNumberProduct',
                    'conditionProduct' => 'required|in:Nuevo,Usado,Dañado,Reparación,Pendiente a buscarse',
                    'statusProduct' => 'required|in:Disponible,Asignado,Reservado,Desechado,Mantenimiento',
                    'locationProduct' => 'required|string|max:255',
                    'purchaseDateProduct' => 'nullable|date',
                    'warrantyExpirationProduct' => 'nullable|date|after_or_equal:purchaseDateProduct',
                    'notesProduct' => 'nullable|string',
                ]);

                if ($validator->fails()) {
                    $errors[] = $data['serialNumberProduct'] ?? 'N/A';
                    continue;
                }

                $data['createdAtProduct'] = now();
                $data['updatedAtProduct'] = now();

                Producto::create($data);
                $imported++;
            }

            DB::commit();

            $message = "$imported productos importados exitosamente.";
            if (!empty($errors)) {
                $message .= ' Algunos productos no fueron importados: ' . implode(', ', $errors);
            }

            return redirect()->route('productos.index')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('productos.index')->with('error', 'Error al importar el archivo: ' . $e->getMessage());
        }
    }
}