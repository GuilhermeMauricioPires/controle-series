@extends('layout')

@section('cabecalho')
    Temporadas de {{ $serie->nome }}
@endsection

@section('conteudo')

    <ul class="list-group">
        @foreach($temporadas as $temporada)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Temporada {{ $temporada->numero }}
                <span class="d-flex align-items-center">
                    <span class="badge badge-secondary mr-1">
                        {{$temporada->episodiosAssistidos()->count()}} / {{ $temporada->episodios->count() }}
                    </span>
                    <a href="/temporada/{{$temporada->id}}/episodios" class="btn btn-info btn-sm">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </span>
            </li>
        @endforeach
    </ul>

@endsection
