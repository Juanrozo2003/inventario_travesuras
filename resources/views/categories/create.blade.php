@extends('layouts.inventario')

@section('content')
<div class="container">
    <h2>Crear Categoría</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nameCategory" class="form-control" value="{{ old('nameCategory') }}" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descriptionCategory" class="form-control">{{ old('descriptionCategory') }}</textarea>
        </div>
        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection

