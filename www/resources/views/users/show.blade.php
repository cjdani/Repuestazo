@extends('layouts.app')

@section('title', 'Mi cuenta')

@section('content')
    <h2>Mi cuenta</h2>
    <p><strong>Nombre:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Rol:</strong> {{ $user->role }}</p>
    @if($user->role === 'empleado' && $user->desguace)
        <p><strong>Desguace:</strong> {{ $user->desguace->nombre }}</p>
    @endif
@endsection
