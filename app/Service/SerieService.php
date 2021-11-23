<?php

namespace App\Service;

use Exception;
use Illuminate\Support\Facades\DB;
use App\{Serie, Temporada, Episodio};

class SerieService
{

    /**
     * @throws Exception
     */
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $qtdEpisodio)
    {
        try {
            DB::beginTransaction();
            $serie = Serie::create(['nome' => $nomeSerie]);
            $this->criarTemporadas($qtdTemporadas, $serie, $qtdEpisodio);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Não foi possível criar a série. " . $e->getMessage());
        }
        return $serie;
    }

    /**
     * @throws Exception
     */
    public function removerSerie(int $serieId): string
    {
        try {
            DB::beginTransaction();
            /** @var Serie $serie */
            $serie = Serie::find($serieId);
            $this->removerTemporadas($serie);
            $nomeSerie = $serie->nome;
            $serie->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Não foi possível criar a série. " . $e->getMessage());
        }
        return $nomeSerie;
    }

    /**
     * @throws Exception
     */
    public function alterarNomeSerie(int $serieId, string $nomeSerie)
    {
        try {
            DB::beginTransaction();
            /** @var Serie $serie */
            $serie = Serie::find($serieId);
            $serie->nome = $nomeSerie;
            $serie->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Não foi possível alterar o nome da série. " . $e->getMessage());
        }
    }

    /**
     * @param Serie $serie
     */
    private function removerTemporadas(Serie $serie): void
    {
        $serie->temporadas()->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    /**
     * @param Temporada $temporada
     */
    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios()->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }

    /**
     * @param int $qtdTemporadas
     * @param Serie $serie
     * @param int $qtdEpisodio
     */
    public function criarTemporadas(int $qtdTemporadas, Serie $serie, int $qtdEpisodio): void
    {
        for ($indexTemporada = 1; $indexTemporada <= $qtdTemporadas; $indexTemporada++) {
            /** @var Temporada $temporadas */
            $temporadas = $serie->temporadas()->create(['numero' => $indexTemporada]);
            $this->criarEpisodios($qtdEpisodio, $temporadas);
        }
    }

    /**
     * @param int $qtdEpisodio
     * @param Temporada $temporadas
     */
    public function criarEpisodios(int $qtdEpisodio, Temporada $temporadas): void
    {
        for ($indexEpsodio = 1; $indexEpsodio <= $qtdEpisodio; $indexEpsodio++) {
            $temporadas->episodios()->create(['numero' => $indexEpsodio]);
        }
    }

}
