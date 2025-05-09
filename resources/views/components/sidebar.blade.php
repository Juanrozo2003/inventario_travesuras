<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Botón de menú hamburguesa (visible en móvil) -->
<button class="btn btn-warning d-md-none m-2 position-fixed top-0 start-0 z-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas">
  <i class="bi bi-list"></i>
</button>

<!-- Sidebar Offcanvas -->
<div class="offcanvas offcanvas-start text-bg-dark d-md-flex flex-column flex-shrink-0 p-3 position-static border-end" tabindex="-1" id="sidebarOffcanvas">
  <!-- Encabezado (solo visible en móviles) -->
  <div class="offcanvas-header d-md-none">
    <h5 class="offcanvas-title">Menú</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>

  <!-- Contenido del sidebar -->
  <div class="offcanvas-body p-0 d-md-flex flex-column">
    <a href="/" class="d-flex align-items-center mb-3 text-white text-decoration-none">
      <span class="fs-4 fw-bold">Inventario Colegio</span>
    </a>
    <hr class="text-white">

    <!-- Navegación principal -->
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="/{{ auth()->user()->rol }}/dashboard" class="nav-link text-white d-flex align-items-center gap-2">
          <i class="bi bi-house-door-fill text-warning"></i> <span>Dashboard</span>
        </a>
      </li>

      @if(auth()->user()->isRectora() || auth()->user()->isSecretaria())
      <li>
        <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#usuariosSubmenu">
          <i class="bi bi-people-fill text-warning"></i> <span>Gestión de Usuarios</span>
        </a>
        <div class="collapse" id="usuariosSubmenu">
          <ul class="list-unstyled ms-4">
            <li><a href="/usuarios" class="nav-link text-white">Ver usuarios</a></li>
            <li><a href="/usuarios/create" class="nav-link text-white">Crear usuario</a></li>
            @if(auth()->user()->isRectora())
            <li><a href="/usuarios/password" class="nav-link text-white">Cambiar contraseña</a></li>
            <li><a href="/roles" class="nav-link text-white">Roles y permisos</a></li>
            @endif
          </ul>
        </div>
      </li>
      @endif

      @if(!auth()->user()->isDocente())
      <li>
        <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#inventarioSubmenu">
          <i class="bi bi-clipboard-data-fill text-warning"></i> <span>Inventario</span>
        </a>
        <div class="collapse" id="inventarioSubmenu">
          <ul class="list-unstyled ms-4">
            <li><a href="/productos" class="nav-link text-white">Productos</a></li>
            <li><a href="/categorias" class="nav-link text-white">Referencias</a></li>
            <li><a href="/inventario/entradas" class="nav-link text-white">Entradas</a></li>
            <li><a href="/inventario/salidas" class="nav-link text-white">Salidas</a></li>
            <li><a href="/inventario/historial" class="nav-link text-white">Historial</a></li>
          </ul>
        </div>
      </li>
      @else
      <li>
        
        <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#inventarioSubmenu">
          <i class="bi bi-clipboard-data-fill text-warning"></i> <span>Inventario</span>
        </a>
        <div class="collapse" id="inventarioSubmenu">
          <ul class="list-unstyled ms-4">
            <li><a href="/inventario/mis-productos" class="nav-link text-white">Mi Stock</a></li>
            <li><a href="/inventario/solicitudes" class="nav-link text-white">Solicitar Material</a></li>
            <li><a href="/inventario/movimientos" class="nav-link text-white">Mi Historial</a></li>
          </ul>
        </div>
      </li>
      @endif

      @if(!auth()->user()->isDocente())
      <li>
        <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#reportesSubmenu">
          <i class="bi bi-bar-chart-fill text-warning"></i> <span>Reportes</span>
        </a>
        <div class="collapse" id="reportesSubmenu">
          <ul class="list-unstyled ms-4">
            <li><a href="/reportes" class="nav-link text-white">Stock actual</a></li>
            <li><a href="/alertas" class="nav-link text-white">Alertas</a></li>
            <li><a href="/exportar" class="nav-link text-white">Exportar Excel/PDF</a></li>
          </ul>
        </div>
      </li>
      @endif

      <li>
        <a href="/documentos" class="nav-link text-white d-flex align-items-center gap-2">
          <i class="bi bi-folder2-open text-warning"></i> <span>Documentación Personal</span>
        </a>
      </li>

      <li>
        <a href="/publicos" class="nav-link text-white d-flex align-items-center gap-2">
          <i class="bi bi-file-earmark-text-fill text-warning"></i> <span>Documentos Públicos</span>
        </a>
      </li>

      <li>
        <a href="https://awp.s5.colpegasus.org/?id=448" class="nav-link text-white d-flex align-items-center gap-2" target="_blank">
          <i class="bi bi-globe2 text-warning"></i> <span>Colpegasus</span>
        </a>
      </li>

      @if(auth()->user()->isRectora())
      <li>
        <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#configSubmenu">
          <i class="bi bi-gear-fill text-warning"></i> <span>Configuración</span>
        </a>
        <div class="collapse" id="configSubmenu">
          <ul class="list-unstyled ms-4">
            <li><a href="/ajustes" class="nav-link text-white">Ajustes del sistema</a></li>
          </ul>
        </div>
      </li>
      @endif

      <li>
        <a href="/acerca" class="nav-link text-white d-flex align-items-center gap-2">
          <i class="bi bi-info-circle-fill text-warning"></i> <span>Acerca de</span>
        </a>
      </li>
    </ul>

    <hr class="text-white">

    <!-- Usuario -->
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
        <img src="https://github.com/mdo.png" alt="perfil" width="32" height="32" class="rounded-circle me-2">
        <strong>{{ auth()->user()->name }}</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="/perfil">Perfil</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="dropdown-item">Cerrar sesión</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</div>

<!-- Bootstrap JS Bundle (incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
