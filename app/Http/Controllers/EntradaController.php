<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::with(['producto.reference'])->orderByDesc('fechaEntrada')->get();
        return view('entradas.index', compact('entradas'));
    }

    public function create()
    {
        $productos = Producto::with('reference')
            ->where('statusProduct', '!=', 'Desechado')
            ->get();
        return view('entradas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idProducto' => [
                'required',
                'exists:products,idProduct',
                function ($attribute, $value, $fail) {
                    $producto = Producto::find($value);
                    if ($producto && $producto->statusProduct === 'Desechado') {
                        $fail('No se pueden registrar entradas para productos desechados.');
                    }
                }
            ],
            'cantidad' => 'required|integer|min:1|max:1000',
            'fechaEntrada' => 'required|date|before_or_equal:today',
            'motivo' => 'required|string|max:255',
            'observaciones' => 'nullable|string|max:500'
        ]);

        try {
            DB::beginTransaction();
            
            $entrada = Entrada::create($validated);
            
            DB::commit();
            
            return redirect()->route('entradas.index')
                ->with('success', 'Entrada registrada exitosamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear entrada: '.$e->getMessage(), ['data' => $request->all()]);
            return back()->withInput()
                ->with('error', 'Error al registrar la entrada: '.$e->getMessage());
        }
    }

    public function edit($id)
    {
        $entrada = Entrada::with('producto.reference')->findOrFail($id);
        $productos = Producto::with('reference')
            ->where('statusProduct', '!=', 'Desechado')
            ->get();
            
        return view('entradas.edit', compact('entrada', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'idProducto' => [
                'required',
                'exists:products,idProduct',
                function ($attribute, $value, $fail) {
                    $producto = Producto::find($value);
                    if ($producto && $producto->statusProduct === 'Desechado') {
                        $fail('No se pueden registrar entradas para productos desechados.');
                    }
                }
            ],
            'cantidad' => 'required|integer|min:1|max:1000',
            'fechaEntrada' => 'required|date|before_or_equal:today',
            'motivo' => 'required|string|max:255',
            'observaciones' => 'nullable|string|max:500'
        ]);

        try {
            DB::beginTransaction();
            
            $entrada = Entrada::findOrFail($id);
            $entrada->update($validated);
            
            DB::commit();
            
            return redirect()->route('entradas.index')
                ->with('success', 'Entrada actualizada correctamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar entrada: '.$e->getMessage(), ['data' => $request->all()]);
            return back()->withInput()
                ->with('error', 'Error al actualizar la entrada: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            Entrada::destroy($id);
            
            DB::commit();
            
            return redirect()->route('entradas.index')
                ->with('success', 'Entrada eliminada correctamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar entrada: '.$e->getMessage());
            return back()
                ->with('error', 'Error al eliminar la entrada: '.$e->getMessage());
        }
    }
}