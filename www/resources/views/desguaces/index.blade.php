@extends('layouts.app')

@section('title', 'Desguaces')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Desguaces</h1>

        <div class="row g-4">
            @foreach($desguaces as $desguace)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset( 'storage/' . $desguace->imagen ) }}"
                             class="card-img-top object-fit-cover" alt="Imagen del desguace" height="200px">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $desguace->nombre }}</h5>
                            <p class="card-text mb-1">{{ $desguace->descripcion }}</p>
                            <p class="card-text mb-1"><strong>Ciudad:</strong> {{ $desguace->ciudad}}</p>
                            <p class="card-text mb-1"><strong>Provincia:</strong> {{ $desguace->provincia }}</p>
                        </div>

                        <div class="card-footer text-center bg-white border-top-0">
                            <a href="{{ route('desguaces.show', $desguace->id) }}" class="btn btn-outline-primary w-100">
                                Ver detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
