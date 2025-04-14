<!-- Botón para abrir sidebar en móviles -->
<button class="btn btn-primary d-md-none m-2" type="button" id="sidebarToggle">
    <i class="bi bi-list"></i>
</button>

<!-- SIDEBAR -->
<div id="sidebar-wrapper" class="position-fixed top-0 start-0 bg-dark text-white p-3" style="width: 280px; height: 100vh; z-index: 1045; transform: translateX(0%); transition: transform 0.3s ease-in-out;">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <span class="fs-4 fw-bold">Inventario Colegio</span>
  </a>
  <hr>

  <div class="d-flex justify-content-end d-md-none">
    <button class="btn btn-sm btn-outline-light mb-2" id="closeSidebar">
      <i class="bi bi-x-lg"></i>
    </button>
  </div>

  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="/{{ auth()->user()->rol }}/dashboard" class="nav-link text-white d-flex align-items-center gap-2">
        <i class="bi bi-house-door-fill text-warning"></i> <span>Dashboard</span>
      </a>
    </li>

    @if(auth()->user()->isRectora() || auth()->user()->isSecretaria())
    <li>
      <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#usuariosSubmenu" role="button">
        <i class="bi bi-people-fill text-warning"></i> <span>Gestión de Usuarios</span>
      </a>
      <div class="collapse" id="usuariosSubmenu">
        <ul class="list-unstyled ms-4">
        <li><a href="{{ url('usuarios') }}" class="nav-link text-white">Ver usuarios</a></li>
        <li><a href="{{ url('usuarios/create') }}" class="nav-link text-white">Crear usuario</a></li>
        @if(auth()->user()->isRectora())
          <li><a href="/usuarios/password" class="nav-link text-white">Cambiar contraseña</a></li>
          <li><a href="/roles" class="nav-link text-white">Roles y permisos</a></li>
          @endif
        </ul>
      </div>
    </li>
    @endif

    @if(auth()->user()->isRectora() || auth()->user()->isSecretaria() || auth()->user()->isContador())
    <li>
      <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#inventarioSubmenu" role="button">
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
    @elseif(auth()->user()->isDocente())
    <li>
      <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#inventarioSubmenu" role="button">
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

    @if(auth()->user()->isRectora() || auth()->user()->isSecretaria() || auth()->user()->isContador())
    <li>
      <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#reportesSubmenu" role="button">
        <i class="bi bi-bar-chart-fill text-warning"></i> <span>Reportes</span>
      </a>
      <div class="collapse" id="reportesSubmenu">
        <ul class="list-unstyled ms-4">
          <li><a href="/reportes" class="nav-link text-white">Stock actual</a></li>
          <li><a href="/alertas" class="nav-link text-white">Alertas de inventario</a></li>
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
      <a href="https://awp.s5.colpegasus.org/?id=448" class="nav-link text-white d-flex align-items-center gap-2">
        <i class="bi bi-globe2 text-warning"></i> <span>Colpegasus</span>
      </a>
    </li>

    @if(auth()->user()->isRectora())
    <li>
      <a class="nav-link text-white d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#configSubmenu" role="button">
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

  <hr>

  <div class="dropdown">
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
      <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
      <strong>{{ auth()->user()->name }}</strong>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
      <li><a class="dropdown-item" href="/perfil">Perfil</a></li>
      <li><hr class="dropdown-divider"></li>
      <li>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button class="dropdown-item" type="submit">Cerrar sesión</button>
        </form>
      </li>
    </ul>
  </div>
</div>

<!-- Overlay para móviles -->
<div id="sidebar-overlay" class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50" style="z-index: 1040; display: none;"></div>

<!-- Scripts para sidebar -->
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
