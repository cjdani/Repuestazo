@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="container py-5 text-center">

        <div class="mb-5">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center text-center text-md-start">
                <img src="{{ asset('storage/images/logo.svg') }}" alt="Logo Repuestazo" height="120" class="mb-3 mb-md-0 me-md-4"">
                <h1 class="display-4 fw-bold">Bienvenido a Repuestazo</h1>
            </div>
            <p class="text-muted mt-2">Tu plataforma de confianza para encontrar y vender repuestos</p>
        </div>

        <div class="row justify-content-center mb-5 g-3">
            <div class="col-12 col-md-4">
                <div class="card shadow-sm p-4 h-100">
                    <h2 class="display-5 fw-bold counter" data-count="{{ $articulos }}">0</h2>
                    <p class="text-muted">Artículos</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow-sm p-4 h-100">
                    <h2 class="display-5 fw-bold counter" data-count="{{ $desguaces }}">0</h2>
                    <p class="text-muted">Desguaces</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card shadow-sm p-4 h-100">
                    <h2 class="display-5 fw-bold counter" data-count="{{ $usuarios }}">0</h2>
                    <p class="text-muted">Usuarios</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="card shadow p-4 p-md-5 text-start">
                    <h3 class="fw-bold mb-4 text-center">¿Qué puedes hacer en Repuestazo?</h3>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <h5><i class="fas fa-search me-2"></i>Buscar Repuestos</h5>
                            <p>Explora cientos de piezas disponibles por toda España.</p>
                        </div>
                        <div class="col-md-4 mb-4">
                            <h5><i class="fas fa-warehouse me-2"></i>Gestionar tu Desguace</h5>
                            <p>Registra tu desguace y sube tus artículos fácilmente.</p>
                        </div>
                        <div class="col-md-4 mb-4">
                            <h5><i class="fas fa-users me-2"></i>Conectar con Clientes</h5>
                            <p>Recibe solicitudes de contacto y amplía tu red.</p>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('articulos.index') }}" class="btn btn-primary">
                            Empezar a explorar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.counter').forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-count');
                const count = +counter.innerText;
                const speed = 20;
                const increment = Math.ceil(target / speed);

                if (count < target) {
                    counter.innerText = count + increment;
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target;
                }
            };

            updateCount();
        });
    </script>
@endsection
