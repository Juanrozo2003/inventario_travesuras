<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameCategory' => 'required|string',
            'descriptionCategory' => 'nullable|string',
        ]);

        Category::create([
            'nameCategory' => $request->nameCategory,
            'descriptionCategory' => $request->descriptionCategory,
            'createdAtCategory' => now(),
            'updatedAtCategory' => now(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nameCategory' => 'required|string',
            'descriptionCategory' => 'nullable|string',
        ]);

        $category->update([
            'nameCategory' => $request->nameCategory,
            'descriptionCategory' => $request->descriptionCategory,
            'updatedAtCategory' => now(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Category $category)
    {
        if ($category->references()->exists()) {
            return redirect()->route('categories.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene referencias asociadas.');
        }
    
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }
}
