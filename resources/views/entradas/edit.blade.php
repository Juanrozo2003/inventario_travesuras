@extends('layouts.inventario')

@section('content')
<div class="container">
    <h2>Editar Entrada</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <form action="{{ route('entradas.update', $entrada->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="idProducto" class="form-label">Producto</label>
            <select name="idProducto" id="idProducto" class="form-select @error('idProducto') is-invalid @enderror" required>
                <option value="">Seleccione un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->idProduct }}" 
                        {{ old('idProducto', $entrada->idProducto) == $producto->idProduct ? 'selected' : '' }}>
                        {{ $producto->reference->nameReference ?? 'Sin referencia' }} - 
                        Serial: {{ $producto->serialNumberProduct ?? 'N/A' }} - 
                        Estado: {{ $producto->statusProduct }}
                    </option>
                @endforeach
            </select>
            @error('idProducto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" 
                   class="form-control @error('cantidad') is-invalid @enderror"
                   value="{{ old('cantidad', $entrada->cantidad) }}" 
                   min="1" max="1000" required>
            @error('cantidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fechaEntrada" class="form-label">Fecha de Entrada</label>
            <input type="date" name="fechaEntrada" id="fechaEntrada"
                   class="form-control @error('fechaEntrada') is-invalid @enderror"
                   value="{{ old('fechaEntrada', $entrada->fechaEntrada->format('Y-m-d')) }}" 
                   max="{{ date('Y-m-d') }}" required>
            @error('fechaEntrada')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo</label>
            <input type="text" name="motivo" id="motivo"
                   class="form-control @error('motivo') is-invalid @enderror"
                   value="{{ old('motivo', $entrada->motivo) }}"
                   maxlength="255" required>
            @error('motivo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea name="observaciones" id="observaciones" 
                     class="form-control @error('observaciones') is-invalid @enderror"
                     rows="3" maxlength="500">{{ old('observaciones', $entrada->observaciones) }}</textarea>
            @error('observaciones')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Actualizar
            </button>
            <a href="{{ route('entradas.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection