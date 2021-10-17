<?php

namespace Tests\Unit;

use App\Dominio\Modelos\Proyecto;
use Tests\TestCase;

class ProyectoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_validar_tipo_de_proyecto_no_valido()
    {
        $proyecto=new Proyecto();
        $this->assertTrue($proyecto->validezTipoProyecto()->fails());
    }

    public function test_validar_tipo_de_proyecto_valido()
    {
        $proyecto=new Proyecto();
        $proyecto->setTipo_proyecto('proyecto de investigacion');
        $this->assertFalse($proyecto->validezTipoProyecto()->fails());
    }

    public function test_proyecto_no_valido()
    {
        $proyecto=new Proyecto();
        $this->assertTrue($proyecto->validez()->fails());
    }

    public function test_proyecto_valido()
    {
        $proyecto=new Proyecto();
        $proyecto->setTitulo('sistema de informacion para gestion de inventario');
        $this->assertFalse($proyecto->validez()->fails());
    }
}
