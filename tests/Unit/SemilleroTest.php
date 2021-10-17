<?php

namespace Tests\Unit;

use App\Dominio\Modelos\Semillero;
use Tests\TestCase;

class SemilleroTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_validar_datos_para_registro_de_semillero_con_datos_no_validos()
    {
        $semillero=new Semillero();
        $this->assertTrue($semillero->validarRegistro()->fails());
    }

    public function test_validar_datos_para_registro_de_semillero_con_datos_validos()
    {
        $semillero=new Semillero();
        $semillero->setNombre('pensamiento algoritmico');
        $this->assertFalse($semillero->validarRegistro()->fails());
    }
}
