<div id="sidebar" class="sidebar d-flex flex-column p-3">

    <div class="d-flex align-items-center justify-content-center mb-4">
        <img src="{{ asset('storage/images/logo.svg') }}" alt="Logo" style="height: 64px; filter: brightness(0) invert(1);" class="logo-margin-fix me-2">
        <h1 class="h4 m-0 nav-text text-white">Repuestazo</h1>
    </div>

    @auth
        <a href="{{ route('user.show') }}" class="d-flex align-items-center mb-4 text-decoration-none text-white">
            <img src="{{ asset('storage/' . Auth::user()->avatar ) }}" class="rounded-circle me-2 bg-light avatar-fixed" alt="Avatar">
            <span class="nav-text">{{ Auth::user()->name }}</span>
        </a>
    @endauth

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('inicio') }}">
                <i class="fas fa-home"></i> <span class="nav-text ms-2">Inicio</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('articulos.index') }}">
                <i class="fas fa-box-open"></i> <span class="nav-text ms-2">Artículos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('desguaces.index') }}">
                <i class="fas fa-warehouse"></i> <span class="nav-text ms-2">Desguaces</span>
            </a>
        </li>
        @auth()
            @if(Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <i class="fas fa-users"></i> <span class="nav-text ms-2">Usuarios</span>
                    </a>
                </li>
            @endif
        @endauth
    </ul>
</div>
