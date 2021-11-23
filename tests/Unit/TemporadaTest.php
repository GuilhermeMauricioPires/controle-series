<?php

namespace Tests\Unit;

use App\Episodio;
use App\Temporada;
use Tests\TestCase;

class TemporadaTest extends TestCase
{
    /** @var Temporada */
    private $temporada;

    protected function setUp(): void
    {
        parent::setUp();
        $temporada = new Temporada();
        $epUm = new Episodio();
        $epUm->assistido = true;
        $epDois = new Episodio();
        $epDois->assistido = false;
        $epTres = new Episodio();
        $epTres->assistido = true;
        $temporada->episodios->add($epUm);
        $temporada->episodios->add($epDois);
        $temporada->episodios->add($epTres);
        $this->temporada = $temporada;
    }


    public function testBuscarTodosOsEpisodios()
    {
        $this->assertCount(3, $this->temporada->episodios);
    }

    public function testBuscaEpAssistido()
    {
        $this->assertCount(2, $this->temporada->episodiosAssistidos());
    }
}
