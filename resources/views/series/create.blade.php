@extends('layout')

@section('cabecalho')
    Adicionar Série
@endsection

@section('conteudo')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post">
        @csrf
        <div class="form-group mb-2">
            <label for="nome" class="">Nome</label>
            <input type="text" class="form-control" name="nome">
        </div>

        <button class="btn-primary">Adicionar</button>
    </form>
@endsection
