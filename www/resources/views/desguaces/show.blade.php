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
            <div class="col-md-6 mb-4 d-flex flex-column justify-content-center">
                <p><strong>Dirección:</strong> {{ $desguace->direccion }}</p>
                <p><strong>Ciudad:</strong> {{ $desguace->ciudad }}</p>
                <p><strong>Provincia:</strong> {{ $desguace->provincia }}</p>
                <p><strong>Email:</strong> {{ $desguace->email }}</p>
                <p><strong>Teléfono:</strong> {{ $desguace->telefono }}</p>
                @auth()
                    @if(Auth::user()->desguace_id == $desguace->id || Auth::user()->role === 'admin' )
                        <div>
                            <strong class="me-3">Acciones:</strong>
                            <a href="@if(Auth::user()->role === 'admin') {{ route('desguaces.show', $desguace->id) }}
                                     @else {{ route('desguaces.show', $desguace->id) }}
                                     @endif" class="btn btn-sm btn-primary me-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="@if(Auth::user()->role === 'admin') {{ route('desguaces.edit', $desguace->id) }}
                                     @else {{ route('desguaces.editSelf') }}
                                     @endif" class="btn btn-sm btn-warning me-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="@if(Auth::user()->id === $desguace->user->id) {{ route('desguaces.deleteSelf') }}
                                          @else {{ route('desguaces.delete', $desguace->id) }}
                                          @endif" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este desguace, se eliminaraán también todos sus artículos?');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="col-md-6">
                <div id="map" style="height: 300px; width: 100%; border-radius: 8px;"></div>
            </div>
        </div>


        <div class="my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Artículos disponibles</h3>
                @auth
                    @if(Auth::user()->desguace_id === $desguace->id)
                        <a href="{{ route('articulos.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Añadir artículo
                        </a>
                    @endif
                @endauth
            </div>

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

            <form method="GET" class="row g-3 mb-4">
                <div class="col-md-3">
                    <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre" value="{{ request('nombre') }}">
                    @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <input type="text" name="marca" class="form-control" placeholder="Marca" value="{{ request('marca') }}">
                    @error('marca')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <input type="text" name="modelo" class="form-control" placeholder="Modelo" value="{{ request('modelo') }}">
                    @error('modelo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-1">
                    <input type="number" name="anio" class="form-control" placeholder="Año" value="{{ request('anio') }}">
                    @error('anio')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <input type="number" step="0.01" name="min_precio" class="form-control" placeholder="Min €" value="{{ request('min_precio') }}">
                    @error('min_precio')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <input type="number" step="0.01" name="max_precio" class="form-control" placeholder="Max €" value="{{ request('max_precio') }}">
                    @error('max_precio')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <a href="{{ route('desguaces.show', $desguace->id) }}" class="btn btn-outline-secondary">Limpiar</a>
                </div>
            </form>

            @if($articulos->count())

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($articulos as $articulo)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset( 'storage/' . $articulo->imagen ) }}"
                                     class="card-img-top object-fit-cover" alt="Imagen del artículo" style="background-color: #e8e8e8;" height="200px">

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $articulo->nombre }}</h5>
                                    <p class="card-text mb-1">{{ $articulo->descripcion }}</p>
                                    <a href="{{ route('desguaces.show', $articulo->desguace->id) }}" class="card-text mb-1 text-decoration-none">
                                        <strong>Desguace:</strong> {{ $articulo->desguace->nombre ?? 'N/A' }}
                                    </a>
                                    <p class="card-text mb-1"><strong>Marca:</strong> {{ $articulo->marca }}</p>
                                    <p class="card-text mb-1"><strong>Modelo:</strong> {{ $articulo->modelo }}</p>
                                    <p class="card-text mb-3"><strong>Año:</strong> {{ $articulo->anio }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="card-text fw-bold fs-5 text-success mt-auto">{{ number_format($articulo->precio, 2 ,',', '.') }}€</p>
                                        @auth()
                                            @if(Auth::user()->role === 'admin' || Auth::user()->desguace->id === $desguace->id)
                                                <div>
                                                    <a href="{{ route('articulos.edit', $articulo->id) }}" class="btn btn-sm btn-warning me-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('articulos.delete', $articulo->id) }}" method="POST" class="d-inline"
                                                          onsubmit="return confirm('¿Estás seguro de eliminar articulo?');">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning">
                    No se encontraron articulos que coincidan con la búsqueda.
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <script>
        const lat = {{ explode(',', $desguace->lat_lon)[0] }};
        const lng = {{ explode(',', $desguace->lat_lon)[1] }};

        const map = L.map('map').setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup("{{ $desguace->nombre }}")
            .openPopup();
    </script>
@endsection
