@extends('layouts.app')

@section('title', 'Artículos')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Artículos disponibles</h1>

        <div class="row g-4">
            @foreach($articulos as $articulo)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset( 'storage/' . $articulo->imagen ) }}"
                             class="card-img-top" alt="Imagen del artículo" style="object-fit: cover; height: 200px;">

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

                        <div class="card-footer text-center bg-white border-top-0">
                            <a href="{{ route('articulos.show', $articulo->id) }}" class="btn btn-outline-primary w-100">
                                Ver detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
