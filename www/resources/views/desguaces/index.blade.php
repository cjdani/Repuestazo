@extends('layouts.app')

@section('title', 'Desguaces')

@section('content')
    <h2>Listado de Desguaces</h2>
    <ul>
        @foreach ($desguaces as $desguace)
            <li>
                <a href="{{ route('desguaces.show', $desguace->id) }}">
                    {{ $desguace->nombre }} - {{ $desguace->ciudad }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
