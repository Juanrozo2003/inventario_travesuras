@extends('layouts.inventario')

@section('content')
<div class="container">
    <h1 class="mb-4">Alertas de Inventario Bajo</h1>

    @if($productosConBajoStock->isEmpty())
        <div class="alert alert-success">
            Todos los productos están dentro del nivel de stock adecuado.
        </div>
    @else
        <div class="alert alert-warning">
            Hay productos con bajo nivel de stock:
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Stock Actual</th>
                    <th>Stock Mínimo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productosConBajoStock as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->stock_minimo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
