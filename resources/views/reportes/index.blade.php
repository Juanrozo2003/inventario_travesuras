@extends('layouts.inventario')

@section('content')
<div class="container">
    <h1 class="mb-4">Reportes del Inventario</h1>

    <div class="card">
        <div class="card-body">
            <p class="text-muted">Aquí se mostrarán los reportes del inventario, como stock actual, productos por categoría, alertas, entre otros.</p>

            {{-- Puedes agregar más contenido dinámico aquí --}}
            <ul>
                <li><a href="#">Stock actual</a></li>
                <li><a href="#">Alertas de inventario</a></li>
                <li><a href="#">Movimientos recientes</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
