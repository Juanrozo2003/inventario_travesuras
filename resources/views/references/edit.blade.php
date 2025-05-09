<!-- resources/views/references/edit.blade.php -->
@extends('layouts.inventario')

@section('content')

<div class="container">
    <h2>Editar Referencia</h2>
    <form action="{{ route('references.update', $reference->idReference) }}" method="POST">
    @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>Categoría</label>
            <select name="idCategory" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->idCategory }}" {{ $reference->idCategory == $category->idCategory ? 'selected' : '' }}>
                        {{ $category->nameCategory }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Código</label>
            <input type="text" name="codeReference" class="form-control" value="{{ $reference->codeReference }}" required>
        </div>

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nameReference" class="form-control" value="{{ $reference->nameReference }}" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descriptionReference" class="form-control">{{ $reference->descriptionReference }}</textarea>
        </div>

        <div class="mb-3">
            <label>Especificaciones</label>
            <textarea name="specificationsReference" class="form-control">{{ $reference->specificationsReference }}</textarea>
        </div>

        <div class="mb-3">
            <label>Stock Mínimo</label>
            <input type="number" name="minStockReference" class="form-control" value="{{ $reference->minStockReference }}">
        </div>

        <div class="mb-3">
            <label>Stock Máximo</label>
            <input type="number" name="maxStockReference" class="form-control" value="{{ $reference->maxStockReference }}">
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
