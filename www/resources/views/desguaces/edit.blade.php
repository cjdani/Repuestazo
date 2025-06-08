@extends('layouts.app')

@section('title', 'Editar Desguace')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Editar Desguace</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <h5 class="fw-bold">Se encontraron errores:</h5>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ $isAdmin ? route('desguaces.edit', $desguace->id) : route('desguaces.editSelf') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $desguace->nombre) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $desguace->telefono) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email de Contacto</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $desguace->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion', $desguace->direccion) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="ciudad" class="form-label">Ciudad</label>
                                <input type="text" name="ciudad" id="ciudad" class="form-control" value="{{ old('ciudad', $desguace->ciudad) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="provincia" class="form-label">Provincia</label>
                                <input type="text" name="provincia" id="provincia" class="form-control" value="{{ old('provincia', $desguace->provincia) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen del Desguace</label>
                                <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                                <small>No introduzca si no quiere cambiar la imagen</small>
                            </div>

                            <div class="mb-3">
                                <input type="hidden" name="ubicacion" id="id_ubicacion">
                                <div id="map" style="height: 400px;" class="rounded shadow my-3"></div>
                                <button type="button" id="locate-btn" class="btn btn-outline-primary mb-3">
                                    <i class="fas fa-location-arrow me-1"></i> Usar mi ubicación
                                </button>
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-save me-1"></i> Guardar Cambios
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
@endsection

@section('scripts')
    <script>
        const defaultLat = {{ explode(',', $desguace->lat_lon)[0] }};
        const defaultLng = {{ explode(',', $desguace->lat_lon)[1] }};

        const map = L.map('map').setView([defaultLat, defaultLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        let marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

        function updateInput(lat, lng) {
            document.getElementById('id_ubicacion').value = `${lat.toFixed(6)},${lng.toFixed(6)}`;
        }

        // Actualizar ubicación al hacer clic en el mapa
        map.on('click', function(e) {
            const { lat, lng } = e.latlng;
            marker.setLatLng([lat, lng]);
            updateInput(lat, lng);
        });

        // Actualizar al arrastrar el marcador
        marker.on('dragend', function(e) {
            const { lat, lng } = e.target.getLatLng();
            updateInput(lat, lng);
        });

        // Botón "Usar mi ubicación"
        const locateBtn = document.getElementById('locate-btn');

        if ("geolocation" in navigator) {
            locateBtn.style.display = 'inline-block';
            locateBtn.addEventListener('click', function () {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    map.setView([lat, lng], 15);
                    marker.setLatLng([lat, lng]);
                    updateInput(lat, lng);
                }, function() {
                    alert("No se pudo obtener tu ubicación.");
                });
            });
        } else {
            locateBtn.style.display = 'none';
        }

        // Valor inicial del input
        updateInput(defaultLat, defaultLng);
    </script>
@endsection
