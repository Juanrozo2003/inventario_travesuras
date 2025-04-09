<header class="header-fixed">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Logo y nombre del colegio -->
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/logoTravesuras.png') }}" alt="Logo Colegio Travesuras" class="header-logo">
                <h1 class="header-title">COLEGIO TRAVESURAS</h1>
            </div>
            
            <!-- Menú de navegación -->
            <nav class="d-none d-lg-block">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('academico') ? 'active' : '' }}" href="{{ route('academico') }}">Académico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admisiones') ? 'active' : '' }}" href="{{ route('admisiones') }}">Admisiones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('nosotros') ? 'active' : '' }}" href="{{ route('nosotros') }}">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contactanos') ? 'active' : '' }}" href="{{ route('contactanos') }}">Contáctanos</a>
                    </li>
                </ul>
            </nav>
            
            <!-- Botón Login/Logout -->
            <div class="d-flex align-items-center">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-logout">Cerrar Sesión</button>
                    </form>
                @endguest
                
                <!-- Menú hamburguesa para móviles -->
                <button class="navbar-toggler d-lg-none ms-3" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        
        <!-- Menú móvil -->
        <div class="collapse d-lg-none" id="mobileMenu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('academico') ? 'active' : '' }}" href="{{ route('academico') }}">Académico</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admisiones') ? 'active' : '' }}" href="{{ route('admisiones') }}">Admisiones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('nosotros') ? 'active' : '' }}" href="{{ route('nosotros') }}">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contactanos') ? 'active' : '' }}" href="{{ route('contactanos') }}">Contáctanos</a>
                </li>
            </ul>
        </div>
    </div>
</header>