<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio Travesuras - @yield('title')</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

      <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Estilos personalizados -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <!-- Estilos adicionales específicos por página -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    </head>

<body>
<body class="d-flex flex-column min-vh-100">
    <!-- Header fijo en la parte superior -->
    @include('partials.header')
    
    <!-- Contenido principal -->
    <main class="flex-grow-1">
        @yield('content')
    </main>
    
    <!-- Footer fijo en la parte inferior -->
    @include('partials.footer')


        <!-- Bootstrap JS CDN (con Popper.js incluido) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @yield('scripts')

    </div>
</body>
</html>
