@extends('layouts.inventario')

@section('content')
<div class="container">

    <h2>Categorías</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Crear Categoría</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->nameCategory }}</td>
                <td>{{ $category->descriptionCategory }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->idCategory) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('categories.destroy', $category->idCategory) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection
