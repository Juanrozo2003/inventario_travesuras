@extends('layouts.inventario')

@section('content')

<div class="container">
    <h2>Editar Usuario</h2>
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        @php $rol = Auth::user()->rol; @endphp

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $usuario->name }}" required {{ $rol === 'secretaria' ? 'readonly' : '' }}>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required {{ $rol === 'secretaria' ? 'readonly' : '' }}>
        </div>

        @if($rol === 'rectora')
        <div class="mb-3">
            <label>Rol</label>
            <select name="rol" class="form-control" required>
                <option value="rectora" @if($usuario->rol == 'rectora') selected @endif>Rectora</option>
                <option value="secretaria" @if($usuario->rol == 'secretaria') selected @endif>Secretaria</option>
                <option value="contador" @if($usuario->rol == 'contador') selected @endif>Contador</option>
                <option value="docente" @if($usuario->rol == 'docente') selected @endif>Docente</option>
            </select>
        </div>
        @endif

        <div class="mb-3">
            <label>Nueva Contraseña (opcional)</label>
            <input type="password" name="password" class="form-control">
            <small class="text-muted">Déjalo vacío si no deseas cambiar la contraseña.</small>
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>

@endsection