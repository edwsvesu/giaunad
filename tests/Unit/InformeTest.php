<?php

namespace Tests\Unit;

use App\Dominio\Modelos\Informe;
use Tests\TestCase;

class InformeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_validez_falsa_de_instancia_de_objeto_informe()
    {
        $informe=new Informe();
        $this->assertTrue($informe->validez()->fails());
    }

    public function test_validez_verdadera_de_instancia_de_objeto_informe()
    {
        $informe=new Informe();
        $informe->setTitulo('entrega de primer informe');
        $this->assertFalse($informe->validez()->fails());
    }
}
