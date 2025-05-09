<!-- resources/views/references/create.blade.php -->
@extends('layouts.inventario')

@section('content')

<div class="container">
    <h2>Crear Referencia</h2>
    <form action="{{ route('references.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Categoría</label>
            <select name="idCategory" class="form-control">
                <option value="">-- Seleccionar Categoría --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->idCategory }}">{{ $category->nameCategory }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Código</label>
            <input type="text" name="codeReference" class="form-control" required>
        </div>


         <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nameReference" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descriptionReference" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Especificaciones</label>
            <textarea name="specificationsReference" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Stock Mínimo</label>
            <input type="number" name="minStockReference" class="form-control">
        </div>

        <div class="mb-3">
            <label>Stock Máximo</label>
            <input type="number" name="maxStockReference" class="form-control">
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
