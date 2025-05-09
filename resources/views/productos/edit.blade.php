@extends('layouts.inventario')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Editar Producto</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('productos.update', $producto->idProduct) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        {{-- Referencia --}}
        <div class="mb-3">
            <label for="idItemReference" class="form-label">Referencia</label>
            <select name="idItemReference" id="idItemReference" class="form-select @error('idItemReference') is-invalid @enderror" required>
                <option value="">-- Selecciona una referencia --</option>
                @foreach($references as $reference)
                    <option value="{{ $reference->idReference }}"
                        {{ old('idItemReference', $producto->idItemReference) == $reference->idReference ? 'selected' : '' }}>
                        {{ $reference->nameReference }} - {{ $reference->category->nameCategory }}
                    </option>
                @endforeach
            </select>
            @error('idItemReference')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Número de serie --}}
        <div class="mb-3">
            <label for="serialNumberProduct" class="form-label">Número de serie</label>
            <input type="text" name="serialNumberProduct" id="serialNumberProduct"
                   class="form-control @error('serialNumberProduct') is-invalid @enderror"
                   value="{{ old('serialNumberProduct', $producto->serialNumberProduct) }}"
                   maxlength="255" autocomplete="off">
            @error('serialNumberProduct')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Condición --}}
        <div class="mb-3">
            <label for="conditionProduct" class="form-label">Condición</label>
            <select name="conditionProduct" id="conditionProduct"
                    class="form-select @error('conditionProduct') is-invalid @enderror" required>
                <option value="">-- Selecciona condición --</option>
                <option value="Nuevo" {{ old('conditionProduct', $producto->conditionProduct) == 'Nuevo' ? 'selected' : '' }}>Nuevo</option>
                <option value="Usado" {{ old('conditionProduct', $producto->conditionProduct) == 'Usado' ? 'selected' : '' }}>Usado</option>
                <option value="Dañado" {{ old('conditionProduct', $producto->conditionProduct) == 'Dañado' ? 'selected' : '' }}>Dañado</option>
                <option value="Reparación" {{ old('conditionProduct', $producto->conditionProduct) == 'Reparación' ? 'selected' : '' }}>Reparación</option>
                <option value="Pendiente a buscarse" {{ old('conditionProduct', $producto->conditionProduct) == 'Pendiente a buscarse' ? 'selected' : '' }}>Pendiente a buscarse</option>
            </select>
            @error('conditionProduct')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Estado --}}
        <div class="mb-3">
            <label for="statusProduct" class="form-label">Estado</label>
            <select name="statusProduct" id="statusProduct"
                   class="form-select @error('statusProduct') is-invalid @enderror" required>
                <option value="">-- Selecciona estado --</option>
                <option value="Disponible" {{ old('statusProduct', $producto->statusProduct) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="Asignado" {{ old('statusProduct', $producto->statusProduct) == 'Asignado' ? 'selected' : '' }}>Asignado</option>
                <option value="Reservado" {{ old('statusProduct', $producto->statusProduct) == 'Reservado' ? 'selected' : '' }}>Reservado</option>
                <option value="Desechado" {{ old('statusProduct', $producto->statusProduct) == 'Desechado' ? 'selected' : '' }}>Desechado</option>
                <option value="Mantenimiento" {{ old('statusProduct', $producto->statusProduct) == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
            </select>
            @error('statusProduct')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Ubicación --}}
        <div class="mb-3">
            <label for="locationProduct" class="form-label">Ubicación</label>
            <input type="text" name="locationProduct" id="locationProduct"
                   class="form-control @error('locationProduct') is-invalid @enderror"
                   value="{{ old('locationProduct', $producto->locationProduct) }}"
                   maxlength="255">
            @error('locationProduct')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Fecha de compra --}}
        <div class="mb-3">
            <label for="purchaseDateProduct" class="form-label">Fecha de compra</label>
            <input type="date" name="purchaseDateProduct" id="purchaseDateProduct"
                   class="form-control @error('purchaseDateProduct') is-invalid @enderror"
                   value="{{ old('purchaseDateProduct', $producto->purchaseDateProduct) }}">
            @error('purchaseDateProduct')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Fin de garantía --}}
        <div class="mb-3">
            <label for="warrantyExpirationProduct" class="form-label">Fin de garantía</label>
            <input type="date" name="warrantyExpirationProduct" id="warrantyExpirationProduct"
                   class="form-control @error('warrantyExpirationProduct') is-invalid @enderror"
                   value="{{ old('warrantyExpirationProduct', $producto->warrantyExpirationProduct) }}">
            @error('warrantyExpirationProduct')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Notas --}}
        <div class="mb-3">
            <label for="notesProduct" class="form-label">Notas</label>
            <textarea name="notesProduct" id="notesProduct" rows="4"
                      class="form-control @error('notesProduct') is-invalid @enderror"
                      maxlength="1000">{{ old('notesProduct', $producto->notesProduct) }}</textarea>
            @error('notesProduct')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botones --}}
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Actualizar
            </button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection