<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio Travesuras - @yield('title')</title>

    <!-- Bootstrap CSS & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSRF Token & Styles -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    @include('partials.header')

    <div class="container-fluid">
        <div class="row">
            @php
                $publicRoutes = [url('/'), url('/academico'), url('/admisiones'), url('/contactanos')];
            @endphp

            @auth
                @if (!in_array(url()->current(), $publicRoutes))
                    <div class="col-md-3 d-none d-md-block">
                        @include('components.sidebar')
                    </div>
                @endif
            @endauth

            <div class="col content" id="mainContent">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>
