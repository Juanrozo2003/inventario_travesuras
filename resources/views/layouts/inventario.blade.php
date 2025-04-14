<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario | @yield('title', 'Panel')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            padding-left: 280px; /* Ajusta según ancho del sidebar */
        }
        @media (max-width: 768px) {
            body {
                padding-left: 0;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Botón para abrir sidebar en móviles -->
    <button class="btn btn-primary d-md-none m-2" type="button" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

    <!-- SIDEBAR -->
    @include('components.sidebar')

    <!-- CONTENIDO PRINCIPAL -->
    <main class="container-fluid p-4">
        @yield('content')
    </main>

    <!-- Overlay para móviles -->
    <div id="sidebar-overlay" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50" style="z-index: 1040; display: none;"></div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebarToggle');
            const closeBtn = document.getElementById('closeSidebar');
            const sidebar = document.getElementById('sidebar-wrapper');
            const overlay = document.getElementById('sidebar-overlay');

            if (toggleBtn && closeBtn && sidebar && overlay) {
                const openSidebar = () => {
                    sidebar.style.transform = 'translateX(0%)';
                    overlay.style.display = 'block';
                };

                const closeSidebar = () => {
                    sidebar.style.transform = 'translateX(-100%)';
                    overlay.style.display = 'none';
                };

                toggleBtn.addEventListener('click', () => {
                    const isOpen = sidebar.style.transform === 'translateX(0%)';
                    isOpen ? closeSidebar() : openSidebar();
                });

                closeBtn.addEventListener('click', closeSidebar);
                overlay.addEventListener('click', closeSidebar);
            }
        });
    </script>

</body>
</html>
