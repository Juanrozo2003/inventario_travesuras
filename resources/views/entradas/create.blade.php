@extends('layouts.inventario')

@section('content')
<div class="container">
    <h2>Nueva Entrada</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('entradas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Producto</label>
            <select name="idProducto" class="form-control select2" required>
                <option value="">Seleccione un producto...</option>
                @forelse($productos as $producto)
                    <option value="{{ $producto->idProduct }}" {{ old('idProducto') == $producto->idProduct ? 'selected' : '' }}>
                        {{ $producto->reference->nameReference ?? 'Sin referencia' }}
                        @isset($producto->serialNumberProduct)
                            ({{ $producto->serialNumberProduct }})
                        @endisset
                        - Estado: {{ $producto->statusProduct }}
                    </option>
                @empty
                    <option value="">No hay productos disponibles</option>
                @endforelse
            </select>
            @if($productos->isEmpty())
                <small class="text-danger">No hay productos registrados en el sistema</small>
            @endif
        </div>

        <div class="mb-3">
            <label>Cantidad</label>
            <input type="number" name="cantidad" class="form-control" required min="1" value="{{ old('cantidad') }}">
        </div>

        <div class="mb-3">
            <label>Fecha de Entrada</label>
            <input type="date" name="fechaEntrada" class="form-control" required 
                   value="{{ old('fechaEntrada', now()->format('Y-m-d')) }}">
        </div>

        <div class="mb-3">
            <label>Motivo</label>
            <input type="text" name="motivo" class="form-control" value="{{ old('motivo') }}" required>
        </div>

        <div class="mb-3">
            <label>Observaciones</label>
            <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('entradas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Seleccione un producto",
            allowClear: true
        });
    });
</script>
@endpush
@endsection