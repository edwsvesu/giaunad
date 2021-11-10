<?php

namespace Tests\Unit;

use App\Dominio\Modelos\EntregaActividad;
use PHPUnit\Framework\TestCase;

class EntregaActividadTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_validar_archivo_vacio_en_entrega_de_actividad()
    {
        $entrega=new EntregaActividad();
        $entrega->setArchivo(null);
        $this->assertTrue($entrega->validarArchivo()->fails());
    }
}
