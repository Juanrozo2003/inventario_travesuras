@extends('layouts.inventario')

@section('content')
<div class="container">
    <h2>Editar Movimiento</h2>
    <form action="{{ route('movements.update', $movement->idMovement) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Producto</label>
            <select name="idProduct" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->idProduct }}" {{ $movement->idProduct == $product->idProduct ? 'selected' : '' }}>
                        {{ $product->serialNumberProduct }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Agrega los otros campos de manera similar -->

        <button type="submit" class="btn btn-success">Actualizar Movimiento</button>
    </form>
</div>
@endsection
