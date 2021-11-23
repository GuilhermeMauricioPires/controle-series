<?php

namespace Tests\Unit;

use App\Serie;
use App\Service\SerieService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SerieTest extends TestCase
{
    use RefreshDatabase;

    /** @var SerieService */
    private $serieService;
    private $nomeSerie = "teste série";

    protected function setUp(): void
    {
        parent::setUp();
        $this->serieService = new SerieService();
    }

    public function testCriarSerie(): Serie
    {
        $serie = $this->serieService->criarSerie($this->nomeSerie, 1, 1);
        $this->assertInstanceOf(Serie::class, $serie);
        $this->assertDatabaseHas('series', ['nome' => $this->nomeSerie]);
        $this->assertDatabaseHas('series', ['id' => $serie->id]);
        $this->assertDatabaseHas('temporadas', ['serie_id' => $serie->id]);
        return $serie;
    }

    /**
     * @depends testCriarSerie
     */
    public function testRemoverSerie(Serie $serie)
    {
        //TODO: AJUSTAR TESTE
        $this->assertDatabaseHas('series', ['id' => $serie->id]);
        $nomeSerieRemovida = $this->serieService->removerSerie($serie->id);
        $this->assertIsString($nomeSerieRemovida);
        $this->assertEquals($this->nomeSerie, $nomeSerieRemovida);
        $this->assertDatabaseMissing('series', ['id' => $serie->id]);
    }

}
