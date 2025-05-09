@extends('layouts.inventario')

@section('content')
<div class="container">
    <h2>Crear Usuario</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Ups! Hay algunos errores.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select name="rol" class="form-control" required>
                @php $rol = Auth::user()->rol; @endphp

                @if($rol === 'rectora')
                    <option value="rectora" {{ old('rol') == 'rectora' ? 'selected' : '' }}>Rectora</option>
                    <option value="secretaria" {{ old('rol') == 'secretaria' ? 'selected' : '' }}>Secretaria</option>
                    <option value="contador" {{ old('rol') == 'contador' ? 'selected' : '' }}>Contador</option>
                @endif
                <option value="docente" {{ old('rol') == 'docente' ? 'selected' : '' }}>Docente</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
