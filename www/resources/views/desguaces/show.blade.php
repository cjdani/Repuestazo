@extends('layouts.app')

@section('title', $desguace->nombre)

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">{{ $desguace->nombre }}</h1>
        <div class="row mb-4">
            <div class="col">
                <img src="{{ asset('storage/' . $desguace->imagen) }}"
                     alt="Imagen del desguace"
                     class="img-fluid rounded shadow w-100"
                     style="max-height: 350px; object-fit: cover;">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <p><strong>Descripción:</strong> {{ $desguace->descripcion ?? 'No disponible' }}</p>
                <p><strong>Dirección:</strong> {{ $desguace->direccion }}</p>
                <p><strong>Ciudad:</strong> {{ $desguace->ciudad }}</p>
                <p><strong>Provincia:</strong> {{ $desguace->provincia }}</p>
                <p><strong>Email:</strong> {{ $desguace->email }}</p>
                <p><strong>Teléfono:</strong> {{ $desguace->telefono }}</p>
            </div>

            <div class="col-md-6">
                <div id="map" style="height: 300px; width: 100%; border-radius: 8px;"></div>
            </div>
        </div>


        <div class="my-5">
            <h3 class="mb-4">Artículos disponibles</h3>

            @if($desguace->articulos->count())
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($desguace->articulos as $articulo)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset( 'storage/' . $articulo->imagen ) }}"
                                     class="card-img-top" alt="Imagen del artículo" style="object-fit: contain;background-color: #e8e8e8; height: 200px;">

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $articulo->nombre }}</h5>
                                    <p class="card-text mb-1">{{ $articulo->descripcion }}</p>
                                    <a href="{{ route('desguaces.show', $articulo->desguace->id) }}" class="card-text mb-1 text-decoration-none">
                                        <strong>Desguace:</strong> {{ $articulo->desguace->nombre ?? 'N/A' }}
                                    </a>
                                    <p class="card-text mb-1"><strong>Categoría:</strong> {{ $articulo->categoria ?? 'Sin categoría' }}</p>
                                    <p class="card-text mb-1"><strong>Marca:</strong> {{ $articulo->marca }}</p>
                                    <p class="card-text mb-1"><strong>Modelo:</strong> {{ $articulo->modelo }}</p>
                                    <p class="card-text mb-3"><strong>Año:</strong> {{ $articulo->anio }}</p>
                                    <p class="card-text fw-bold fs-5 text-success mt-auto">€{{ number_format($articulo->precio, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning">
                    Este desguace no tiene artículos disponibles actualmente.
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <script>
        const lat = {{ $desguace->lat ?? '37.3891' }};
        const lng = {{ $desguace->lng ?? '-5.9845' }};

        const map = L.map('map').setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup("{{ $desguace->nombre }}")
            .openPopup();
    </script>
@endsection
