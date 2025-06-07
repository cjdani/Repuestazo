@extends('layouts.app')

@section('title', 'Editar Artículo')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Editar Artículo</h2>

                        <form method="POST" action="{{ route('articulos.edit', $articulo->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Artículo</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $articulo->nombre) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $articulo->descripcion) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text" name="marca" id="marca" class="form-control" value="{{ old('marca', $articulo->marca) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="modelo" class="form-label">Modelo</label>
                                <input type="text" name="modelo" id="modelo" class="form-control" value="{{ old('modelo', $articulo->modelo) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="anio" class="form-label">Año</label>
                                <input type="number" name="anio" id="anio" class="form-control" value="{{ old('anio', $articulo->anio) }}" min="1900" max="{{ date('Y') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio (€)</label>
                                <input type="number" name="precio" id="precio" class="form-control" value="{{ old('precio', $articulo->precio) }}" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Imagen Actual</label>
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $articulo->imagen) }}" alt="Imagen del Artículo" class="img-thumbnail" width="200">
                                </div>
                                <label for="imagen" class="form-label">Cambiar Imagen (opcional)</label>
                                <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
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
