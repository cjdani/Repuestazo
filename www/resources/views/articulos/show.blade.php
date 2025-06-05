@extends('layouts.app')

@section('title', $articulo->nombre)

@section('content')
    <h2>{{ $articulo->nombre }}</h2>
    <p><strong>Precio:</strong> {{ $articulo->precio }} €</p>
    <p><strong>Descripción:</strong> {{ $articulo->descripcion }}</p>
@endsection
