@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Publicaciones</div>

                <div class="card-body">
                    <div class="row">
                        <nav class="nav">
                        <a class="nav-link" href="{{ route('publications.create')}}">Crear nueva publicacion</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col">
                            @if ($publications->isNotEmpty())
                            <ul>
                                @foreach ($publications as $pub)
                                    <li>
                                    <a href="{{ route('publications.show', $pub) }}">{{ $pub->title}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            @else
                            <span>No existen publicaciones</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
