@extends('layouts.inventario')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Gestión de Usuarios</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Crear Usuario
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ ucfirst($usuario->rol) }}</td>
                        <td class="text-center">
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>

                            @if(auth()->check() && auth()->user()->rol === 'rectora')
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Está segura de eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
