@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="home-hero">
    <div class="container">
        <h1>Bienvenido al Colegio Travesuras</h1>
        <p>Una institución educativa comprometida con la excelencia académica y la formación integral de nuestros estudiantes.</p>
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Acceso al Sistema</a>
    </div>
</div>



<div class="container feature-cards">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <i class="fas fa-graduation-cap fa-3x mb-3 text-primary"></i>
                    <h3>Excelencia Académica</h3>
                    <p>Programas educativos de calidad avalados por el Ministerio de Educación.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                    <h3>Comunidad</h3>
                    <p>Un ambiente familiar donde cada estudiante es valorado como individuo único.</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <i class="fas fa-futbol fa-3x mb-3 text-primary"></i>
                    <h3>Actividades Extracurriculares</h3>
                    <p>Programas deportivos, artísticos y culturales para el desarrollo integral.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection