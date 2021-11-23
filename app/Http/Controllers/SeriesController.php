<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Service\SerieService;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request): string
    {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');
        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, SerieService $serieService)
    {
        $serie = $serieService->criarSerie($request->get('nome'), $request->get('qtd_temporadas'), $request->get('qtd_episodios'));
        $request->session()->flash("mensagem" , "Série {$serie->id} criada com sucesso: {$serie->nome}");
        return redirect()->route('listar_series');
    }

    public function destroy(Request $request, SerieService $serieService)
    {
        $nomeSerieExcluida = $serieService->removerSerie($request->id);
        $request->session()->flash("mensagem" , "Série '{$nomeSerieExcluida}' excluida com sucesso");
        return redirect()->route('listar_series');
    }

    public function edit(int $id, Request $request, SerieService $serieService)
    {
        $novoNome = $request->nome;
        $serieService->alterarNomeSerie($id, $novoNome);
    }

}
