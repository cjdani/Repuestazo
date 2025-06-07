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
                    <th class="d-none d-xl-table-cell">Email</th>
                    <th class="d-none d-lg-table-cell">Rol</th>
                    <th class="d-none d-xl-table-cell">Desguace</th>
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
                        <td class="d-none d-xl-table-cell">{{ $user->email }}</td>
                        <td class="d-none d-lg-table-cell">{{ ucfirst($user->role) }}</td>
                        <td class="d-none d-xl-table-cell">
                            @if ($user->desguace)
                                <a href="{{ route('desguaces.show', $user->desguace->id) }}">
                                    {{ $user->desguace->nombre }}
                                </a>
                            @else
                                —
                            @endif
                        </td>
                        <td class="align-middle px-3">
                            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-2 h-100">
                                <a href="{{ route('user.details', $user->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('user.delete', $user->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Estás seguro de eliminar este usuario{{ $user->desguace ? '?, se eliminará el desguace asociado y sus artículos' : '?' }}');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
