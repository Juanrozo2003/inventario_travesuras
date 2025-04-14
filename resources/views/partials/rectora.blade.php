@extends('layouts.app')

@section('content')
<div class="d-flex">
    {{-- SIDEBAR visible en todos los tamaños (ajustable con media queries si lo deseas) --}}
    <div>
        @include('components.sidebar')
    </div>

    {{-- CONTENIDO PRINCIPAL --}}
    <div class="flex-grow-1 p-4" style="margin-left: 280px;">
        <h1>Bienvenida, rectora</h1>
        <p>Este es tu panel de control.</p>
    </div>
</div>
@endsection
