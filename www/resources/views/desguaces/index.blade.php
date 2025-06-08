@extends('layouts.app')

@section('title', 'Desguaces')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Desguaces</h1>

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
            <div class="col-md-4">
                <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre" value="{{ request('nombre') }}">
                @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <input type="text" name="ciudad" class="form-control" placeholder="Ciudad" value="{{ request('ciudad') }}">
                @error('ciudad')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <input type="text" name="provincia" class="form-control" placeholder="Provincia" value="{{ request('provincia') }}">
                @error('provincia')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="{{ route('desguaces.index') }}" class="btn btn-outline-secondary">Limpiar</a>
            </div>
        </form>

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
