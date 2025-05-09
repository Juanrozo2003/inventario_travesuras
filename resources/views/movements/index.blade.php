@extends('layouts.inventario')

@section('content')

<div class="container">
    <h2>Historial de Movimientos</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('movements.create') }}" class="btn btn-primary mb-3">Registrar Movimiento</a>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Tipo de Movimiento</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movements as $movement)
                <tr>
                    <td>{{ $movement->product->nombreProducto ?? 'N/A' }}</td>
                    <td>{{ ucfirst($movement->movementType->nombreTipoMovimiento ?? 'N/A') }}</td>
                    <td>{{ $movement->quantityMovement }}</td>
                    <td>{{ $movement->dateMovement }}</td>
                    <td>{{ $movement->reasonMovement }}</td>
                    <td>
                        <a href="{{ route('movements.edit', $movement->idMovement) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('movements.destroy', $movement->idMovement) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
