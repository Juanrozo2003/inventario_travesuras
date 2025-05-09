<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reference;
use App\Models\Category;

class ReferenceController extends Controller
{
    // Mostrar todas las referencias
    public function index()
    {
        // Se incluye la relación con categoría
        $references = Reference::with('category')->get();
        return view('references.index', compact('references'));
    }

    // Mostrar formulario para crear una nueva referencia
    public function create()
    {
        $categories = Category::all();
        return view('references.create', compact('categories'));
    }

    // Guardar una nueva referencia
    public function store(Request $request)
    {
        $request->validate([
            'idCategory' => 'required|exists:categories,idCategory',
            'codeReference' => 'required|string',
            'nameReference' => 'required|string',
            'descriptionReference' => 'nullable|string',
            'specificationsReference' => 'nullable|string',
            'minStockReference' => 'nullable|integer|min:0',
            'maxStockReference' => 'nullable|integer|min:0',
        ]);

        Reference::create([
            'idCategory' => $request->idCategory,
            'codeReference' => $request->codeReference,
            'nameReference' => $request->nameReference,
            'descriptionReference' => $request->descriptionReference,
            'specificationsReference' => $request->specificationsReference,
            'minStockReference' => $request->minStockReference,
            'maxStockReference' => $request->maxStockReference,
            'createdAtReference' => now(),
            'updatedAtReference' => now(),
        ]);

        return redirect()->route('references.index')->with('success', 'Referencia creada correctamente.');
    }

    // Mostrar formulario de edición de una referencia existente
    public function edit(Reference $reference)
    {
        $categories = Category::all(); // 👈 nombre correcto para usar en la vista
        return view('references.edit', compact('reference', 'categories'));
    }

    // Actualizar una referencia existente
    public function update(Request $request, Reference $reference)
    {
        $request->validate([
            'idCategory' => 'required|exists:categories,idCategory',
            'codeReference' => 'required|string',
            'nameReference' => 'required|string',
            'descriptionReference' => 'nullable|string',
            'specificationsReference' => 'nullable|string',
            'minStockReference' => 'nullable|integer|min:0',
            'maxStockReference' => 'nullable|integer|min:0',
        ]);

        $reference->update([
            'idCategory' => $request->idCategory,
            'codeReference' => $request->codeReference,
            'nameReference' => $request->nameReference,
            'descriptionReference' => $request->descriptionReference,
            'specificationsReference' => $request->specificationsReference,
            'minStockReference' => $request->minStockReference,
            'maxStockReference' => $request->maxStockReference,
            'updatedAtReference' => now(),
        ]);

        return redirect()->route('references.index')->with('success', 'Referencia actualizada correctamente.');
    }

    // Eliminar una referencia
    public function destroy(Reference $reference)
    {
        $reference->delete();
        return redirect()->route('references.index')->with('success', 'Referencia eliminada correctamente.');
    }
}
