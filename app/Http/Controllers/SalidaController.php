<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SalidaController extends Controller
{
    public function index()
    {
        $salidas = Salida::with('producto')->orderByDesc('fechaSalida')->get();
        return view('salidas.index', compact('salidas'));
    }

    public function create()
    {
        $productos = Producto::where('statusProduct', 'available')->get();
        return view('salidas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idProducto' => [
                'required',
                'exists:products,idProduct',
                function ($attribute, $value, $fail) {
                    $producto = Producto::find($value);
                    if (!$producto || $producto->statusProduct !== 'available') {
                        $fail('El producto seleccionado no está disponible.');
                    }
                }
            ],
            'cantidad' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request) {
                    $producto = Producto::find($request->idProducto);
                    if ($producto) {
                        $entradas = DB::table('entradas')
                            ->where('idProducto', $producto->idProduct)
                            ->sum('cantidad');
                        $salidas = DB::table('salidas')
                            ->where('idProducto', $producto->idProduct)
                            ->sum('cantidad');
                        $stock = $entradas - $salidas;
                        
                        if ($value > $stock) {
                            $fail('La cantidad excede el stock disponible ('.$stock.' unidades).');
                        }
                    }
                }
            ],
            'fechaSalida' => [
                'required',
                'date',
                'before_or_equal:today'
            ],
            'motivo' => [
                'required',
                'string',
                'max:255'
            ],
            'observaciones' => [
                'nullable',
                'string',
                'max:500'
            ]
        ]);

        try {
            DB::beginTransaction();

            $salida = Salida::create($validated);

            DB::commit();

            return redirect()->route('salidas.index')
                ->with('success', 'Salida registrada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error al registrar la salida: '.$e->getMessage());
        }
    }

    public function edit(Salida $salida)
    {
        $productos = Producto::all();
        return view('salidas.edit', compact('salida', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $salida = Salida::findOrFail($id);

        $validated = $request->validate([
            'idProducto' => [
                'required',
                'exists:products,idProduct',
                function ($attribute, $value, $fail) {
                    $producto = Producto::find($value);
                    if (!$producto || $producto->statusProduct !== 'available') {
                        $fail('El producto seleccionado no está disponible.');
                    }
                }
            ],
            'cantidad' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request, $salida) {
                    $producto = Producto::find($request->idProducto);
                    if ($producto) {
                        $entradas = DB::table('entradas')
                            ->where('idProducto', $producto->idProduct)
                            ->sum('cantidad');
                        $salidas = DB::table('salidas')
                            ->where('idProducto', $producto->idProduct)
                            ->where('id', '!=', $salida->id)
                            ->sum('cantidad');
                        $stock = $entradas - $salidas;
                        
                        if ($value > $stock) {
                            $fail('La cantidad excede el stock disponible ('.$stock.' unidades).');
                        }
                    }
                }
            ],
            'fechaSalida' => [
                'required',
                'date',
                'before_or_equal:today'
            ],
            'motivo' => [
                'required',
                'string',
                'max:255'
            ],
            'observaciones' => [
                'nullable',
                'string',
                'max:500'
            ]
        ]);

        try {
            DB::beginTransaction();

            $salida->update($validated);

            DB::commit();

            return redirect()->route('salidas.index')
                ->with('success', 'Salida actualizada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error al actualizar la salida: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $salida = Salida::findOrFail($id);
            $salida->delete();

            DB::commit();

            return redirect()->route('salidas.index')
                ->with('success', 'Salida eliminada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al eliminar la salida: '.$e->getMessage());
        }
    }

}