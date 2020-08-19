@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Publicacion</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <p>{{ $publication->title }}</p>
                        <p>{{ $publication->content }}</p>
                        <p>Autor: {{ $publication->user->name }}</p>
                        @if ($publication->user->id == auth()->user()->id)
                        <p> 
                            <a href="{{ route('publications.edit', $publication) }}">Editar</a> -
                            <a href="#" onclick="eliminarPublication()">Eliminar</a>
                        </p>

                        <form id="delete-publication" action="{{ route('publications.destroy', $publication) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                    
                        <script>
                            function eliminarPublication() {
                                let form = document.getElementById('delete-publication')
                                form.submit()
                            }
                        </script> 
                        @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Solo se muestra si el usuario puede comentar --}}
            @if ($canPostComment)
            <div class="card mt-3">
                <div class="card-header">Dejar comentario</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('comments.store')}}" method="POST">
                                @csrf
                                <textarea id="content" class="form-control mb-3" name="content" placeholder="Comentario..."></textarea>
                                <button class="btn btn-primary" type="submit" name="send">Enviar</button>
                                <input type="hidden" id="publication_id" name="publication_id" value="{{ $publication->id }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Lista de comentarios --}}
            <div class="card mt-3">
                <div class="card-header">Comentarios</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            @if ($publication->comments->isNotEmpty())
                                @foreach ($publication->comments as $comment)
                                    <p>{{ $comment->user->name }}: {{ $comment->content }}</p>
                                @endforeach
                            @else
                                <p>No hay comentarios en esta publicacion</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
