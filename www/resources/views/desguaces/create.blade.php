@extends('layouts.app')

@section('title', 'Crear Desguace')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Crear Desguace</h2>

                        <form method="POST" action="{{ route('desguaces.create') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Nombre del desguace --}}
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Desguace</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>

                            {{-- Dirección --}}
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" required>
                            </div>

                            {{-- Teléfono --}}
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" name="telefono" id="telefono" class="form-control" required>
                            </div>

                            {{-- Email de contacto --}}
                            <div class="mb-3">
                                <label for="email_contacto" class="form-label">Email de Contacto</label>
                                <input type="email" name="email_contacto" id="email_contacto" class="form-control" required>
                            </div>

                            {{-- Imagen del desguace --}}
                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen del Desguace</label>
                                <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*" required>
                            </div>

                            {{-- Botón --}}
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-plus me-1"></i> Crear Desguace
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
