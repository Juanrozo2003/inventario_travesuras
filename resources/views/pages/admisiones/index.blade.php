@extends('layouts.app')

@section('title', 'Admisiones')

@section('content')
<div class="container py-5">



  <!-- Carrusel de imágenes -->
<div id="carouselAdmisiones" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner rounded shadow carousel-fix-height">
        <div class="carousel-item active">
            <img src="{{ asset('images/admisiones1.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Admisiones 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/admisiones2.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Admisiones 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/admisiones3.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Admisiones 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAdmisiones" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselAdmisiones" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>


     
    <!-- Título -->
    <h1 class="text-center mb-4">Admisiones</h1>
    <p class="text-center mb-5">Consulta los requisitos y el calendario escolar según el grado, y descarga el formulario único de inscripción.</p>
    <!-- Formulario Único -->
     <div class="mt-5 text-center">
        <h4>Formulario Único de Inscripción</h4>
        <p>Puedes ver o descargar el formulario general de admisiones para cualquier grado.</p>
        <a href="{{ asset('docs/formulario_inscripcion.pdf') }}" target="_blank" class="btn btn-outline-primary me-2">Ver Formulario</a>
        <a href="{{ asset('docs/formulario_inscripcion.pdf') }}" download class="btn btn-primary">Descargar Formulario</a>
    </div>
    <!-- Acordeón -->
    <div class="accordion" id="accordionAdmisiones">

        @php
            $grados = [
                'Prejardín' => 'Debe tener mínimo 2 años cumplidos. Disposición para el trabajo en grupo y autonomía en actividades básicas.',
                'Jardín' => 'Debe tener mínimo 3 años cumplidos. Capacidad para seguir instrucciones simples y habilidades básicas de comunicación.',
                'Transición' => 'Debe tener mínimo 4 años cumplidos. Buen manejo del lenguaje oral y disposición para el aprendizaje escolar.',
                'Primero' => 'Debe haber cursado Transición. Reconocimiento de letras, números y habilidades básicas de escritura.',
                'Quinto' => 'Certificados de años anteriores. Nivel académico acorde al grado y entrevista de admisión.'
            ];
        @endphp

        @foreach($grados as $grado => $requisitos)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $loop->index }}">
                <button class="accordion-button {{ !$loop->first ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $loop->index }}">
                    Requisitos y Calendario - Grado {{ $grado }}
                </button>
            </h2>
            <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionAdmisiones">
                <div class="accordion-body">
                    <h5>Requisitos Mínimos</h5>
                    <p>{{ $requisitos }}</p>

                    <h5 class="mt-4">Calendario Escolar</h5>
                    <p>Puedes consultar el calendario escolar completo del grado {{ $grado }} en la sección administrativa del colegio o solicitándolo directamente.</p>
                </div>
            </div>
        </div>
        @endforeach

    </div>

   
</div>
@endsection
