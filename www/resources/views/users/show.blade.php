@extends('layouts.app')

@section('title', 'Mi Cuenta')

@section('content')
    <div class="container py-5">
        <div class="row g-4 d-flex justify-content-center">
            {{-- Card con datos del usuario --}}
            <div class="col-md-6">
                <div class="card shadow-sm text-center p-4">
                    <img src="{{ asset('storage/' . $user->avatar) }}"
                         alt="Avatar de {{ $user->name }}"
                         width="120" height="120"
                         class="rounded-circle object-fit-cover mx-auto mb-3 border">

                    <h4 class="mb-2">{{ $user->name }}</h4>
                    <p class="mb-1 text-muted"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="mb-0 text-muted"><strong>Rol:</strong> {{ ucfirst($user->role) }}</p>

                    @if ($user->role === 'cliente')
                        <a href="{{ route('desguaces.create') }}" class="btn btn-outline-primary mt-3">
                            Crear Desguace Asociado
                        </a>
                    @endif
                </div>
            </div>

            {{-- Si es empleado, mostrar datos del desguace asociado --}}
            @if ($user->role === 'empleado' && $user->desguace)
                <div class="col-md-6">
                    <div class="card shadow-sm text-center p-4">
                        <img src="{{ asset('storage/' . $user->desguace->imagen) }}"
                             alt="Imagen del desguace"
                             width="120" height="120"
                             class="rounded object-fit-cover mx-auto mb-3 border">

                        <h5 class="mb-2">{{ $user->desguace->nombre }}</h5>

                        <a href="{{ route('desguaces.show', $user->desguace->id) }}"
                           class="btn btn-outline-secondary btn-sm">
                            Ver Desguace
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
