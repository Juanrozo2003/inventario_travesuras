@extends('layouts.app')
@section('title', 'Recuperar Contraseña')

@section('content')
<div class="container">
    <div class="login container">
        <h1 class="login-title">RECUPERAR CONTRASEÑA</h1>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Restablecer contraseña</h5>
            </div>
            
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="login-form">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input id="email" type="email" class="form-control border-0 border-bottom rounded-0 @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                               style="box-shadow: none !important;">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Botón de envío -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">
                            Enviar enlace de restablecimiento
                        </button>
                    </div>

                    <!-- Volver a login -->
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            ← ¿Ya estas registrado?, Inicia sesión:
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection