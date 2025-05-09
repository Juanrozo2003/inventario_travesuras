@extends('layouts.inventario')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Productos</h1>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif


    {{-- Botón para crear nuevo producto --}}
    <div class="mb-3">
        <a href="{{ route('productos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nuevo Producto
        </a>
    </div>

    


    {{-- Tabla de productos --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Referencia</th>
                    <th>Categoría</th>
                    <th>Serial</th>
                    <th>Condición</th>
                    <th>Estado</th>
                    <th>Ubicación</th>
                    <th>Fecha de Compra</th>
                    <th>Garantía</th>
                    <th>Notas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $producto)
                    <tr>
                        <td class="text-center">{{ $producto->idProduct }}</td>
                        <td>{{ $producto->reference->nameReference ?? 'N/A' }}</td>
                        <td>{{ $producto->reference->category->nameCategory ?? 'Sin categoría' }}</td>
                        <td>{{ $producto->serialNumberProduct ?? '-' }}</td>
                        <td>{{ $producto->conditionProduct ?? '-' }}</td>
                        <td>{{ $producto->statusProduct ?? '-' }}</td>
                        <td>{{ $producto->locationProduct ?? '-' }}</td>
                        <td>{{ $producto->purchaseDateProduct ? \Carbon\Carbon::parse($producto->purchaseDateProduct)->format('d/m/Y') : '-' }}</td>
                        <td>{{ $producto->warrantyExpirationProduct ? \Carbon\Carbon::parse($producto->warrantyExpirationProduct)->format('d/m/Y') : '-' }}</td>
                        <td>{{ $producto->notesProduct ?? '-' }}</td>
                        <td class="text-nowrap text-center">
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-warning me-1" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted">No hay productos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
