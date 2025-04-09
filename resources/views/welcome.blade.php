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

<section class="container my-5">
    <div class="row align-items-center">
        <!-- Texto de Misión y Visión -->
        <div class="col-md-6 text-center text-md-start">
            <h2>MISIÓN</h2>
            <p>Formar personas íntegras y competentes a través de una educación innovadora, inclusiva y de calidad, preparándolas para los retos del futuro.</p>
            <h2>VISIÓN</h2>
            <p>Ser reconocidos como un referente educativo que inspira el crecimiento personal, académico y social de nuestros estudiantes.</p>
        </div>
        <!-- Imagen del colegio -->
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/ColegioTravesuras.jpeg') }}" alt="Colegio Travesuras" class="img-fluid shadow">
        </div>
    </div>
</section>

<!-- Sección de Valores -->
<section class="values container my-5">
    <h2 class="text-center mb-4">NUESTROS VALORES</h2>
    <div class="row text-center">
        <div class="col-md-2 col-6 mb-4">
            <img src="{{ asset('images/Honestidad.jpeg') }}" alt="Honestidad" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
            <p>Honestidad en la sinceridad y/o veracidad</p>
        </div>
        <div class="col-md-2 col-6 mb-4">
            <img src="{{ asset('images/Justicia.png') }}" alt="Justicia" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
            <p>Justicia en la igualdad y armonía en nuestra sociedad</p>
        </div>
        <div class="col-md-2 col-6 mb-4">
            <img src="{{ asset('images/responsabilidad.png') }}" alt="Responsabilidad" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
            <p>Responsabilidad en el cumplimiento de sus deberes</p>
        </div>
        <div class="col-md-2 col-6 mb-4">
            <img src="{{ asset('images/Libertad.png') }}" alt="Libertad" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
            <p>Libertad con plena responsabilidad</p>
        </div>
        <div class="col-md-2 col-6 mb-4">
            <img src="{{ asset('images/Solidaridad.jpg') }}" alt="Solidaridad" class="img-fluid rounded-circle mb-2" style="width: 100px; height: 100px; object-fit: cover;">
            <p>Solidaridad buscando el bien común</p>
        </div>
    </div>
</section>
@endsection