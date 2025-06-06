@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="container">
        <h1 class="mb-4">Listado de Usuarios</h1>

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Desguace</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                 alt="Foto de {{ $user->name }}"
                                 width="60"
                                 height="60"
                                 class="rounded-circle object-fit-cover">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            @if ($user->desguace)
                                <a href="{{ route('desguaces.show', $user->desguace->id) }}">
                                    {{ $user->desguace->nombre }}
                                </a>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('user.details', $user->id) }}" class="btn btn-sm btn-primary me-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{-- route('user.edit', $user->id) --}}" class="btn btn-sm btn-warning me-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{-- route('user.destroy', $user->id) --}}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
