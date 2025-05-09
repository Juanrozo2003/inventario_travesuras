// resources/views/contador/reportes.blade.php
@extends('layouts.inventario')

@section('content')
<div class="container">
    <h1 class="mb-4">Generar Reportes</h1>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('contador.generar-reporte') }}" method="POST">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_fin" class="form-label">Fecha Fin</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="tipo_reporte" class="form-label">Tipo de Reporte</label>
                        <select class="form-select" id="tipo_reporte" name="tipo_reporte" required>
                            <option value="entradas">Entradas</option>
                            <option value="salidas">Salidas</option>
                            <option value="ambos">Entradas y Salidas</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-file-earmark-text"></i> Generar Reporte
                    </button>
                    <a href="{{ route('contador.dashboard') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver al Panel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection