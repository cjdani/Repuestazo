<header class="bg-light border-bottom px-3 py-2 d-flex justify-content-between align-items-center flex-wrap gap-2">
    <button id="toggle-menu" class="btn btn-outline-secondary d-flex align-items-center">
        <i class="fas fa-bars"></i>
    </button>

    @auth
        <a href="{{ route('logout') }}" class="btn btn-outline-danger d-flex align-items-center">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    @endauth

    @guest
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('register') }}" class="btn btn-outline-primary d-flex align-items-center">
                <i class="fas fa-user-plus"></i>
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-success d-flex align-items-center">
                <i class="fas fa-sign-in-alt"></i>
            </a>
        </div>
    @endguest
</header>
