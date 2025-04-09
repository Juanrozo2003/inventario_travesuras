@extends('layouts.app')

@section('title', 'Contáctanos')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Contáctanos</h1>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h3 class="card-title">Información de Contacto</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-map-marker-alt me-2"></i> Calle 4 E Nº 24 - 03 Manzana B, Villavicencio, Meta</li>
                        <li class="mb-3"><i class="fab fa-whatsapp me-2"></i> <a href="https://wa.me/573223199206" target="_blank" class="text-decoration-none text-dark">+57 322 3199206</a></li>
                        <li class="mb-3"><i class="fas fa-envelope me-2"></i> info@colegiotravesuras.edu</li>
                        <li><i class="fas fa-clock me-2"></i> Lunes a Viernes: 7:00 AM - 4:00 PM</li>
                    </ul>
                    
                    <div class="mt-4">
                        <h4>Síguenos</h4>
                        <a href="https://www.facebook.com/colegiotravesuras/?_rdc=1&_rdr" target="_blank" class="me-3 text-decoration-none">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a href="https://www.instagram.com/colegiotravesuras/" target="_blank" class="me-3 text-decoration-none">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="https://wa.me/573223199206" target="_blank" class="me-3 text-decoration-none">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title">Formulario de Contacto</h3>
                    <form>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="asunto" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="mensaje" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-5">
        <div class="ratio ratio-16x9">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.5206970356764!2d-73.63443262510718!3d4.138064195778571!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3e2de663d1c7e7%3A0xb28d27aa84ae19a9!2sCalle%204%20E%20%23%2024-3%2C%20Villavicencio%2C%20Meta!5e0!3m2!1ses!2sco!4v1712502989896!5m2!1ses!2sco" 
                width="600" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>
@endsection
