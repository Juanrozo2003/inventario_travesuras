<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio Travesuras - @yield('title')</title>

    <!-- Bootstrap CSS & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Bootstrap Bundle con Popper (necesario para colapsables) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CSRF Token & Styles -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    @include('partials.header')

    <body class="d-flex">
    
    <!-- Sidebar -->
    <div id="sidebar" class="bg-dark text-white position-fixed h-100"
        style="width: 250px; transform: translateX(-100%); transition: transform 0.3s; z-index: 1041;">
        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
            <span class="fs-5">Menú</span>
            <button id="closeSidebar" class="btn btn-sm btn-light">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        @php $rol = Auth::user()->rol ?? null; @endphp
        <ul class="nav flex-column p-3">
        {{-- Dashboard por rol --}}
            @if($rol === 'rectora')
                <li class="nav-item"><a href="{{ route('rectora.dashboard') }}" class="nav-link text-white"><i class="bi bi-person-fill-gear me-2 text-warning"></i> Panel Rectora</a></li>
            @elseif($rol === 'docente')
                <li class="nav-item"><a href="{{ route('docente.dashboard') }}" class="nav-link text-white"><i class="bi bi-journal-text me-2 text-warning"></i> Panel Docente</a></li>
            @elseif($rol === 'secretaria')
                <li class="nav-item"><a href="{{ route('secretaria.dashboard') }}" class="nav-link text-white"><i class="bi bi-people-fill me-2 text-warning"></i> Panel Secretaria</a></li>
            @elseif($rol === 'contador')
                <li class="nav-item"><a href="{{ route('contador.dashboard') }}" class="nav-link text-white"><i class="bi bi-cash-stack me-2 text-warning"></i> Panel Contador</a></li>
            @endif

            <!-- Gestión de Usuarios -->
            @if($rol === 'rectora' || $rol === 'secretaria')
            <li>
                <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#usuariosSubmenu" role="button" aria-expanded="false" aria-controls="usuariosSubmenu">
                    <i class="bi bi-people-fill text-warning"></i> <span>Gestión de Usuarios</span>
                </a>
                <div class="collapse" id="usuariosSubmenu">
                    <ul class="list-unstyled ms-4">
                        <li><a href="{{ route('usuarios.index') }}" class="nav-link text-white">Ver usuarios</a></li>
                        @if($rol === 'rectora')
                            <li><a href="{{ route('usuarios.create') }}" class="nav-link text-white">Crear usuario</a></li>
                        @elseif($rol === 'secretaria')
                            <li><a href="{{ route('usuarios.create') }}" class="nav-link text-white">Crear docente</a></li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif


            <li>
                <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#inventarioSubmenu">
                    <i class="bi bi-clipboard-data-fill text-warning"></i> <span>Inventario</span>
                </a>
                <div class="collapse" id="inventarioSubmenu">
                    <ul class="list-unstyled ms-4">
                        <li><a href="{{ route('productos.index') }}" class="nav-link text-white">Productos</a></li> 
                        <li><a href="{{ route('categories.index') }}" class="nav-link text-white">Categorias</a></li>
                        <li><a href="{{ route('references.index') }}" class="nav-link text-white">Referencias</a></li>
                        <li><a href="{{ route('entradas.index') }}" class="nav-link text-white">Entradas</a></li>
                        <li><a href="{{ route('salidas.index') }}" class="nav-link text-white">Salidas</a></li>
                        <li><a href="{{ route('historial.index') }}" class="nav-link text-white">Historial</a></li>
                    </ul>
                </div>
            </li>

            <li>
                <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#reportesSubmenu">
                    <i class="bi bi-bar-chart-fill text-warning"></i> <span>Reportes</span>
                </a>
                <div class="collapse" id="reportesSubmenu">
                    <ul class="list-unstyled ms-4">
                        <li><a href="{{ route('reportes.index') }}" class="nav-link text-white">Stock actual</a></li>
                        <li><a href="{{ route('alertas.index') }}" class="nav-link text-white">Alertas</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item"><a href="https://awp.s5.colpegasus.org/?id=448" target="_blank" class="nav-link text-white"><i class="bi bi-globe2 text-warning me-2"></i> Colpegasus</a></li>

            <li>
                <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#configSubmenu">
                    <i class="bi bi-gear-fill text-warning"></i> <span>Configuración</span>
                </a>
                
            </li>


            <li class="nav-item">
                <a href="#" class="nav-link text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2 text-danger"></i> Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </li>
        </ul>
    </div>


    <!-- Botón hamburguesa -->
    <button id="sidebarToggle" class="btn btn-dark position-fixed top-0 start-0 m-3 z-3">
        <i class="bi bi-list"></i>
    </button>

    <!-- Overlay para móviles -->
    <div id="sidebarOverlay" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50" style="z-index: 1040; display: none;"></div>

    <!-- Contenido principal -->
    <div id="mainContent" class="flex-grow-1 p-4" style="margin-left: 0;">
        @yield('content')
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const closeBtn = document.getElementById('closeSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const mainContent = document.getElementById('mainContent');

        const openSidebar = () => {
            sidebar.style.transform = 'translateX(0%)';
            overlay.style.display = 'block';
            if (window.innerWidth >= 768) {
                mainContent.style.marginLeft = '250px';
            }
        };

        const closeSidebar = () => {
            sidebar.style.transform = 'translateX(-100%)';
            overlay.style.display = 'none';
            mainContent.style.marginLeft = '0';
        };

        toggleBtn?.addEventListener('click', () => {
            const isOpen = sidebar.style.transform === 'translateX(0%)';
            if (isOpen) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        closeBtn?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);

        // Mantener sidebar abierto en escritorio si es necesario
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768 && sidebar.style.transform === 'translateX(0%)') {
                mainContent.style.marginLeft = '250px';
            } else if (window.innerWidth < 768) {
                mainContent.style.marginLeft = '0';
            }
        });
    </script>



    @include('partials.footer')
</body>
</html>

