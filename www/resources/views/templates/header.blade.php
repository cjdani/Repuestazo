<header class="bg-light border-bottom p-3 d-flex justify-content-between align-items-center">
    <button id="toggle-menu" class="btn btn-outline-secondary">
        <i class="fas fa-bars"></i>
    </button>
    @auth
        <a href="{{ route('logout') }}" class="btn btn-outline-danger">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    @endauth

    @guest
        <div class="d-flex gap-2">
            <a href="{{ route('register') }}" class="btn btn-outline-primary">
                <i class="fas fa-user-plus"></i>
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-success">
                <i class="fas fa-sign-in-alt"></i>
            </a>
        </div>
    @endguest
</header>
