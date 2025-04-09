@extends('layouts.app')

@section('title', 'Área Académica')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-RMxNyeXnDdPpE8sxv6ZbU8k8aBkO2ZkEjcOl3HHcyx2Qd8JlWcBBZ7EVq8LmwlGG" crossorigin="anonymous">
<!-- Bootstrap Bundle JS (incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqD1z9PjEc7FfJt9P1LJ1zIbbVYUew+OrCXaRkfjRgH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<style>
    /* Sidebar personalizado */
    #sidebarAcademico {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        background-color: #343a40;
        color: white;
        padding: 1rem;
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
        z-index: 1050;
    }

    #sidebarAcademico.active {
        transform: translateX(0);
    }

    #sidebarAcademico .list-group-item {
        background: transparent;
        color: white;
        border: none;
        cursor: pointer;
    }

    #sidebarAcademico .list-group-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Botón hamburguesa flotante */
    #toggleSidebarBtn {
        position: fixed;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        z-index: 1100;
        border-radius: 0 5px 5px 0;
        display: none; /* Oculto al inicio */
    }
</style>

<!-- Botón flotante para abrir/cerrar sidebar -->
<button id="toggleSidebarBtn" class="btn btn-primary">
    <i class="bi bi-list"></i>
</button>

<!-- Sidebar personalizado -->
<div id="sidebarAcademico">
    <h5>📚 Documentos Académicos</h5>
    <div class="list-group mt-3">
        <button class="list-group-item" onclick="loadPDF('manual_convivencia.pdf')">Manual de Convivencia</button>
        <button class="list-group-item" onclick="loadPDF('proyectos_transversales.pdf')">Proyectos Transversales</button>
        <button class="list-group-item" onclick="loadPDF('calendario_estudiantil.pdf')">Calendario Estudiantil</button>
        <button class="list-group-item" onclick="loadPDF('malla_curricular.pdf')">Malla Curricular</button>
    </div>
</div>

<div class="container py-5">
    <h1 class="text-center mb-5">Nuestro Programa Académico</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>Educación de Calidad</h2>
            <p>Nuestro currículo está diseñado para desarrollar las habilidades intelectuales, sociales y emocionales de nuestros estudiantes.</p>

            <div class="accordion mt-4" id="academicAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#preescolar">
                            Preescolar
                        </button>
                    </h2>
                    <div id="preescolar" class="accordion-collapse collapse show" data-bs-parent="#academicAccordion">
                        <div class="accordion-body">
                            <p>Programa diseñado para el desarrollo integral de niños de 3 a 5 años.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#primaria">
                            Primaria
                        </button>
                    </h2>
                    <div id="primaria" class="accordion-collapse collapse" data-bs-parent="#academicAccordion">
                        <div class="accordion-body">
                            <p>Educación básica de 1° a 5° grado con enfoque en competencias fundamentales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Imagen + visor PDF -->
        <div class="col-md-6">
            <img src="{{ asset('images/academico.jpg') }}" alt="Programa académico" class="img-fluid rounded shadow mb-3">

            <!-- Visor de PDF -->
            <div id="pdfViewer" class="d-none">
                <button class="btn btn-danger mb-2" onclick="hidePDF()">❌ Ocultar PDF</button>
                <iframe id="pdfFrame" src="" width="100%" height="400px" class="border rounded shadow"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Toast de error -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 2000;">
    <div id="pdfToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                El PDF solicitado no existe. 📄❌
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Mostrar botón flotante después de cargar
    window.onload = () => {
        document.getElementById('toggleSidebarBtn').style.display = 'block';
    };

    const sidebar = document.getElementById('sidebarAcademico');
    const toggleBtn = document.getElementById('toggleSidebarBtn');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });

    function loadPDF(pdfFile) {
        const pdfPath = `/docs/${pdfFile}`;
        const iframe = document.getElementById('pdfFrame');

        fetch(pdfPath, { method: 'HEAD' })
            .then(res => {
                if (res.ok) {
                    iframe.src = pdfPath;
                    document.getElementById('pdfViewer').classList.remove('d-none');
                } else {
                    showToast();
                }
            })
            .catch(() => {
                showToast();
            });
    }

    function hidePDF() {
        document.getElementById('pdfViewer').classList.add('d-none');
        document.getElementById('pdfFrame').src = "";
    }

    function showToast() {
        const toast = new bootstrap.Toast(document.getElementById('pdfToast'));
        toast.show();
    }
</script>
@endpush
@endsection
