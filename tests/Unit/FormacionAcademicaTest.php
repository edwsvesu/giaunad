<?php

namespace Tests\Unit;

use App\Dominio\Modelos\FormacionAcademica;
use Tests\TestCase;

class FormacionAcademicaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_validez_falsa_de_instancia_de_objeto_de_formacio_academica()
    {
        $formacionAcademica=new FormacionAcademica();
        $this->assertTrue($formacionAcademica->validez()->fails());
    }

    public function test_validez_verdadera_de_instancia_de_objeto_de_formacio_academica()
    {
        $formacionAcademica=new FormacionAcademica();
        $formacionAcademica->setTitulo('Ingenieria de sistemas');
        $this->assertFalse($formacionAcademica->validez()->fails());
    }
}
