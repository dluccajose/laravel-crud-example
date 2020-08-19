@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear nueva publicacion</div>

                <div class="card-body">

                    {{-- mostrar rrores --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach      
                            </ul>
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('publications.store') }}" method="POST">
                                {{-- Colocar directiva csrf que inserta el token contra ataques --}}
                                @csrf
                                <input type="text" id="title" class="form-control mb-3" name="title" placeholder="Titulo..." >
                                <textarea id="content" class="form-control mb-3" name="content" placeholder="Contenido..."></textarea>
                                <button class="btn btn-primary" type="submit" name="send">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
