@extends('layouts.app')

@section('content')
<div>
        @include('components.sidebar')
    </div>
<div class="container">
    <h2>Crear Usuario</h2>
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Rol</label>
            <select name="rol" class="form-control" required>
                <option value="rectora">Rectora</option>
                <option value="secretaria">Secretaria</option>
                <option value="contador">Contador</option>
                <option value="docente">Docente</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
