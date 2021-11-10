<?php

namespace Tests\Unit;

use App\Dominio\Modelos\Actividad;
use Tests\TestCase;

class ActividadTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_validar_instancia_de_actividad_para_registro_con_informacion_no_valida()
    {
        $actividad=new Actividad();
        $actividad->setFecha_entrega('2021-12-12');
        $this->assertTrue($actividad->validarRegistro()->fails());
    }

    public function test_validar_instancia_de_actividad_para_registro_con_informacion_valida()
    {
        $actividad=new Actividad();
        $actividad->setTitulo('desarrollo de primer acta de registro');
        $actividad->setFecha_entrega('2021-12-12');
        $actividad->setInstrucciones('adjuntar la entrega por favor.');
        $actividad->setSemillero_id(1);
        $this->assertFalse($actividad->validarRegistro()->fails());
    }

    public function test_validar_instancia_de_actividad_para_editar_con_informacion_no_valida()
    {
        $actividad=new Actividad();
        $actividad->setFecha_entrega('2019-0101');
        $actividad->setInstrucciones('Desarrollar la actividad como se indica');
        $this->assertTrue($actividad->validarEditar()->fails());
    }

    public function test_validar_instancia_de_actividad_para_editar_con_informacion_valida()
    {
        $actividad=new Actividad();
        $actividad->setTitulo('primer entrega de taller grupal');
        $actividad->setFecha_entrega('2021-07-15');
        $actividad->setInstrucciones('Desarrollar la actividad como se indica');
        $actividad->setSemillero_id(1);
        $this->assertFalse($actividad->validarEditar()->fails());
    }
}
