@extends('layout')

@section('cabecalho')
    Adicionar Série
@endsection

@section('conteudo')

    @include('erros')

    <form method="post">
        @csrf
        <div class="row">
            <div class="col col-8">
                <label for="nome" class="">Nome</label>
                <input type="text" class="form-control" name="nome">
            </div>
            <div class="col col-2">
                <label for="qtd_temporadas" class="">Nº temporadas</label>
                <input type="number" class="form-control" name="qtd_temporadas">
            </div>
            <div class="col col-2">
                <label for="qtd_episodios" class="">Nº episodios</label>
                <input type="number" class="form-control" name="qtd_episodios">
            </div>
        </div>

        <button class="btn btn-primary mt-2">Adicionar</button>
    </form>
@endsection
