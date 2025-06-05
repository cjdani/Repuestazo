@extends('layouts.app')

@section('title', $desguace->nombre)

@section('content')
    <h2>{{ $desguace->nombre }}</h2>
    <p><strong>Ciudad:</strong> {{ $desguace->ciudad }}</p>
    <p><strong>Dirección:</strong> {{ $desguace->direccion }}</p>
@endsection
