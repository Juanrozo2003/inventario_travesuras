@extends('layouts.inventario')

@section('content')
<div class="container">
    <h1>Gestión de Salidas</h1>
    <a href="{{ route('salidas.create') }}" class="btn btn-primary mb-3">Registrar Nueva Salida</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                    <th>Motivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($salidas as $salida)
                    <tr>
                        <td>{{ $salida->producto->serialNumberProduct }}</td>
                        <td>{{ $salida->cantidad }}</td>
                        <td>{{ $salida->fechaSalida->format('d/m/Y') }}</td>
                        <td>{{ $salida->motivo }}</td>
                        <td>
                            <a href="{{ route('salidas.edit', $salida->id) }}" 
                               class="btn btn-sm btn-warning" title="Editar">
                               <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('salidas.destroy', $salida->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        title="Eliminar"
                                        onclick="return confirm('¿Confirmar eliminación?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay registros de salidas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection