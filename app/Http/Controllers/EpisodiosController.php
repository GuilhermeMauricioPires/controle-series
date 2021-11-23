<?php

namespace App\Http\Controllers;

use App\Service\EpisodioService;
use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Request $request, Temporada $temporada)
    {
        $serie = $temporada->serie;
        $episodios = $temporada->episodios;
        $mensagem = $request->getSession()->get('mensagem');
        return view('episodios.index', compact('episodios', 'temporada', 'serie', 'mensagem'));
    }

    public function edit(Request $request, Temporada $temporada, EpisodioService $episodioService)
    {
        $episodioService->assistirEpisodios($temporada, $request->get('episodios', []));
        $request->session()->flash("mensagem" , "Episódio(s) atualizados com sucesso");
        return redirect()->route('listar_episodios', ['temporada' => $temporada->id]);
    }

}
