<?php

namespace Tests\Unit;

use App\Dominio\Modelos\FormacionIdioma;
use Tests\TestCase;

class FormacionIdiomaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_validez_falsa_de_instancia_de_objeto_de_formacion_de_idioma()
    {
        $formacionIdioma=new FormacionIdioma();
        $this->assertTrue($formacionIdioma->validez()->fails());
    }

    public function test_validez_verdadera_de_instancia_de_objeto_de_formacion_de_idioma()
    {
        $formacionIdioma=new FormacionIdioma();
        $formacionIdioma->setLectura('bueno');
        $formacionIdioma->setEscritura('bueno');
        $formacionIdioma->setEscucha('bueno');
        $this->assertFalse($formacionIdioma->validez()->fails());
    }
}
