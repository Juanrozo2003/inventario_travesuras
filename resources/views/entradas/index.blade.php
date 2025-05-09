@extends('layouts.inventario')

@section('content')
<div class="container">
    <h2>Listado de Entradas</h2>
    <a href="{{ route('entradas.create') }}" class="btn btn-primary mb-3">Nueva Entrada</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Referencia</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entradas as $entrada)
                <tr>
                    <td>{{ $entrada->id }}</td>
                    <td>
                        @if($entrada->producto)
                            {{ $entrada->producto->serialNumberProduct ?? 'Sin serial' }}
                        @else
                            Producto no encontrado
                        @endif
                    </td>
                    <td>
                        @if($entrada->producto && $entrada->producto->reference)
                            {{ $entrada->producto->reference->nameReference }}
                        @else
                            Sin referencia
                        @endif
                    </td>
                    <td>{{ $entrada->cantidad }}</td>
                    <td>{{ $entrada->fechaEntrada->format('d/m/Y') }}</td>
                    <td>{{ $entrada->motivo }}</td>
                    <td>
                        <a href="{{ route('entradas.edit', $entrada->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('entradas.destroy', $entrada->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta entrada?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection