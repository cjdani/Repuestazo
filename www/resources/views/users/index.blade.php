@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="container">
        <h1 class="mb-4">Listado de Usuarios</h1>

        <form method="GET" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
                </div>

                <div class="col-md-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ request('email') }}">
                </div>

                <div class="col-md-3">
                    <label for="role" class="form-label">Rol</label>
                    <select name="role" id="role" class="form-select">
                        <option value="">Todos</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" @selected(request('role') === $role)>
                                {{ ucfirst($role) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="desguace_id" class="form-label">Desguace</label>
                    <select name="desguace_id" id="desguace_id" class="form-select">
                        <option value="">Todos</option>
                        @foreach ($desguaces as $desguace)
                            <option value="{{ $desguace->id }}" @selected(request('desguace_id') == $desguace->id)>
                                {{ $desguace->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 d-flex justify-content-end gap-2">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Limpiar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i> Filtrar
                    </button>
                </div>
            </div>
        </form>

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
