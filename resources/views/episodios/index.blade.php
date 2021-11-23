@extends('layout')

@section('cabecalho')
    {{ $serie->nome }} - Temporada {{ $temporada->numero }}
@endsection

@section('conteudo')

    <form action="/temporada/{{$temporada->id}}/episodios/assistir" method="POST">
        @csrf
        <ul class="list-group">
            @foreach($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episodio->numero }}
                    <input type="checkbox" name="episodios[]" value="{{$episodio->id}}" @if($episodio->assistido) checked @endif @guest disabled @endguest>
                </li>
            @endforeach
        </ul>
        <button class="btn btn-primary mt-2 mb-2">Salvar</button>
    </form>

@endsection
