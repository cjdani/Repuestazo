@extends('layouts.app')

@section('title', 'Mi Cuenta')

@section('content')
    <div class="container py-5">
        <div class="row row-cols-1 row-cols-md-2 g-4 align-items-stretch">
            <div class="col">
                <div class="card shadow-sm text-center p-4 h-100">
                    <img src="{{ asset('storage/' . $user->avatar) }}"
                         alt="Avatar de {{ $user->name }}"
                         width="120" height="120"
                         style="object-fit: cover;"
                         class="rounded-circle mx-auto mb-3 border">

                    <h4 class="mb-2">{{ $user->name }}</h4>
                    <p class="mb-1 text-muted"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="mb-0 text-muted"><strong>Rol:</strong> {{ ucfirst($user->role) }}</p>

                    <a href="@if(Auth::user()->id === $user->id)  {{ route('user.editSelf') }}
                             @else {{ route('user.edit', $user->id) }}
                             @endif" class="btn btn-warning mt-4">
                        Editar Perfil
                    </a>

                    <form action="@if(Auth::user()->id === $user->id)  {{ route('user.deleteSelf') }}
                                  @else {{ route('user.delete', $user->id) }}
                                  @endif"  method="POST" class="d-inline"
                          onsubmit="return confirm('¿Estás seguro de eliminar la cuenta{{ $user->desguace ? '?, se eliminará el desguace asociado y sus artículos' : '?' }}');">
                        @csrf
                        <button type="submit" class="btn btn-danger mt-3 w-100">
                            Eliminar Cuenta
                        </button>
                    </form>

                    @if (Auth::user()->id === $user->id && $user->role === 'cliente')
                        <a href="{{ route('desguaces.create') }}" class="btn btn-outline-primary mt-4">
                            Crear Desguace Asociado
                        </a>
                    @endif
                </div>
            </div>

            @if ($user->role === 'empleado' && $user->desguace)
                <div class="col">
                    <div class="card shadow-sm text-center p-4 h-100">
                        <img src="{{ asset('storage/' . $user->desguace->imagen) }}"
                             alt="Imagen del desguace"
                             style="height: 200px; object-fit: cover;"
                             class="rounded mx-auto mb-3 border w-100">

                        <h5 class="mb-2">{{ $user->desguace->nombre }}</h5>

                        <a href="{{ route('desguaces.show', $user->desguace->id) }}"
                           class="btn btn-outline-secondary mt-auto">
                            Ver Desguace
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
