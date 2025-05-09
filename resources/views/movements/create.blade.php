@extends('layouts.inventario')

@section('content')
<div class="container">
    <h2>Registrar Movimiento</h2>
    <form action="{{ route('movements.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Producto</label>
            <select name="idProduct" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->idProduct }}">{{ $product->serialNumberProduct }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Usuario</label>
            <select name="idUser" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tipo de Movimiento</label>
            <select name="idMovementType" class="form-control" required>
                @foreach($movementTypes as $type)
                    <option value="{{ $type->idMovementType }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Cantidad</label>
            <input type="number" name="quantityMovement" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="dateMovement" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Motivo</label>
            <input type="text" name="reasonMovement" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Número de Documento</label>
            <input type="text" name="documentNumberMovement" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Notas</label>
            <textarea name="notesMovement" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Registrar Movimiento</button>
    </form>
</div>
@endsection
