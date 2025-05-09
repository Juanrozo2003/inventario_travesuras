@extends('layouts.inventario')

@section('content')
<div class="container">
    <h1>Crear Producto</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="idItemReference" class="form-label">Referencia</label>
            <select name="idItemReference" class="form-select @error('idItemReference') is-invalid @enderror" required>
                <option value="">Seleccione una referencia</option>
                @foreach($references as $reference)
                    <option value="{{ $reference->idReference }}" {{ old('idItemReference') == $reference->idReference ? 'selected' : '' }}>
                        {{ $reference->nameReference }} - {{ $reference->category->nameCategory }}
                    </option>
                @endforeach
            </select>
            @error('idItemReference') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Número de serie</label>
            <input type="text" name="serialNumberProduct" class="form-control @error('serialNumberProduct') is-invalid @enderror" value="{{ old('serialNumberProduct') }}">
            @error('serialNumberProduct') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Condición</label>
            <select name="conditionProduct" class="form-select @error('conditionProduct') is-invalid @enderror" required>
                <option value="">Seleccione la condición</option>
                <option value="Nuevo" {{ old('conditionProduct') == 'Nuevo' ? 'selected' : '' }}>Nuevo</option>
                <option value="Usado" {{ old('conditionProduct') == 'Usado' ? 'selected' : '' }}>Usado</option>
                <option value="Dañado" {{ old('conditionProduct') == 'Dañado' ? 'selected' : '' }}>Dañado</option>
                <option value="Reparación" {{ old('conditionProduct') == 'Reparación' ? 'selected' : '' }}>Reparación</option>
                <option value="Pendiente a buscarse" {{ old('conditionProduct') == 'Pendiente a buscarse' ? 'selected' : '' }}>Pendiente a buscarse</option>
            </select>
            @error('conditionProduct') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="statusProduct" class="form-select @error('statusProduct') is-invalid @enderror" required>
                <option value="">Seleccione el estado</option>
                <option value="Disponible" {{ old('statusProduct') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="Asignado" {{ old('statusProduct') == 'Asignado' ? 'selected' : '' }}>Asignado</option>
                <option value="Reservado" {{ old('statusProduct') == 'Reservado' ? 'selected' : '' }}>Reservado</option>
                <option value="Desechado" {{ old('statusProduct') == 'Desechado' ? 'selected' : '' }}>Desechado</option>
                <option value="Mantenimiento" {{ old('statusProduct') == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
            </select>
            @error('statusProduct') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ubicación</label>
            <input type="text" name="locationProduct" class="form-control @error('locationProduct') is-invalid @enderror" value="{{ old('locationProduct') }}">
            @error('locationProduct') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de compra</label>
            <input type="date" name="purchaseDateProduct" class="form-control @error('purchaseDateProduct') is-invalid @enderror" value="{{ old('purchaseDateProduct') }}">
            @error('purchaseDateProduct') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Fin de garantía</label>
            <input type="date" name="warrantyExpirationProduct" class="form-control @error('warrantyExpirationProduct') is-invalid @enderror" value="{{ old('warrantyExpirationProduct') }}">
            @error('warrantyExpirationProduct') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Notas</label>
            <textarea name="notesProduct" class="form-control @error('notesProduct') is-invalid @enderror">{{ old('notesProduct') }}</textarea>
            @error('notesProduct') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Guardar
        </button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection