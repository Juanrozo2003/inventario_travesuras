@extends('layouts.inventario')

@section('content')

<div class="container">
    <h2>Registrar Nueva Salida</h2>
    <form action="{{ route('salidas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Producto</label>
            <select name="idProducto" class="form-control" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->idProduct }}">{{ $producto->serialNumberProduct }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Cantidad</label>
            <input type="number" name="cantidad" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Fecha de Salida</label>
            <input type="date" name="fechaSalida" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Motivo</label>
            <input type="text" name="motivo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Observaciones</label>
            <textarea name="observaciones" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
