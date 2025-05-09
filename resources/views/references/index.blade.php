@extends('layouts.inventario')

@section('content')
<div class="container">
    <h1>Gestión de Referencias</h1>
    <a href="{{ route('references.create') }}" class="btn btn-primary mb-3">Crear Referencia</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($references as $reference)
                <tr>
                    <td>{{ $reference->nameReference }}</td>
                    <td>{{ $reference->descriptionReference ?? 'N/A' }}</td>
                    <td>{{ $reference->category->nameCategory ?? 'Sin categoría' }}</td>
                    <td>
                        <a href="{{ route('references.edit', $reference->idReference) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('references.destroy', $reference->idReference) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta referencia?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

