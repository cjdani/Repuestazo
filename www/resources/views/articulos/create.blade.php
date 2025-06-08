@extends('layouts.app')

@section('title', 'Crear Artículo')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Crear Artículo</h2>

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

                        <form method="POST" action="{{ route('articulos.create') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Artículo</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text" name="marca" id="marca" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="modelo" class="form-label">Modelo</label>
                                <input type="text" name="modelo" id="modelo" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="anio" class="form-label">Año</label>
                                <input type="number" name="anio" id="anio" class="form-control" min="1900" max="{{ date('Y') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio (€)</label>
                                <input type="number" name="precio" id="precio" class="form-control" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen del Artículo</label>
                                <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-1"></i> Crear Artículo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
