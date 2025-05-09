@extends('layouts.inventario')

@section('content')

<div class="container">
    <h2>Editar Salida</h2>
    <form action="{{ route('salidas.update', $salida->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Producto</label>
            <select name="idProducto" class="form-control" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->idProduct }}" @if($producto->idProduct == $salida->idProducto) selected @endif>{{ $producto->serialNumberProduct }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Cantidad</label>
            <input type="number" name="cantidad" class="form-control" value="{{ $salida->cantidad }}" required>
        </div>
        <div class="mb-3">
            <label>Fecha de Salida</label>
            <input type="date" name="fechaSalida" class="form-control" value="{{ $salida->fechaSalida }}" required>
        </div>
        <div class="mb-3">
            <label>Motivo</label>
            <input type="text" name="motivo" class="form-control" value="{{ $salida->motivo }}" required>
        </div>
        <div class="mb-3">
            <label>Observaciones</label>
            <textarea name="observaciones" class="form-control">{{ $salida->observaciones }}</textarea>
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
