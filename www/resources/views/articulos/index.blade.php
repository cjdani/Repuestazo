@extends('layouts.app')

@section('title', 'Artículos')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Artículos disponibles</h1>

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
                <select name="desguace_id" class="form-select">
                    <option value="">Todos los desguaces</option>
                    @foreach ($desguaces as $desguace)
                        <option value="{{ $desguace->id }}" {{ request('desguace_id') == $desguace->id ? 'selected' : '' }}>
                            {{ $desguace->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('desguace_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-1">
                <input type="number" step="0.01" name="min_precio" class="form-control" placeholder="Min €" value="{{ request('min_precio') }}">
                @error('min_precio')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-1">
                <input type="number" step="0.01" name="max_precio" class="form-control" placeholder="Max €" value="{{ request('max_precio') }}">
                @error('max_precio')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('articulos.index') }}" class="btn btn-outline-secondary">Limpiar</a>
            </div>
        </form>


        <div class="row g-4">
            @foreach($articulos as $articulo)
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
                            <p class="card-text mb-1"><strong>Marca:</strong> {{ $articulo->marca }}</p>
                            <p class="card-text mb-1"><strong>Modelo:</strong> {{ $articulo->modelo }}</p>
                            <p class="card-text mb-3"><strong>Año:</strong> {{ $articulo->anio }}</p>
                            <p class="card-text fw-bold fs-5 text-success mt-auto">{{ number_format($articulo->precio, 2 ,',', '.') }}€</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
