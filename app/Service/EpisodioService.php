<?php

namespace App\Service;

use App\Episodio;
use App\Temporada;
use Exception;
use Illuminate\Support\Facades\DB;

class EpisodioService
{

    /**
     * @throws Exception
     */
    public function assistirEpisodios(Temporada $temporada, array $episodios = [])
    {
        try {
            DB::beginTransaction();
            $temporada->episodios()->each(function (Episodio $episodio) use ($episodios) {
                $episodio->assistido = in_array($episodio->id, $episodios);
                $episodio->save();
            });
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
            throw new Exception("Não foi possível atualizar a lista de episódios. " . $e->getMessage());
        }
    }

}
