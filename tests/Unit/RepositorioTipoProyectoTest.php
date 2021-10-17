<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioTipoProyecto;
use Tests\TestCase;

class RepositorioTipoProyectoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_insertar_registro_de_tipo_de_proyecto()
    {
        $RepositorioTipoProyecto=new RepositorioTipoProyecto();
        $this->assertIsInt($RepositorioTipoProyecto->insertar('nuevo tipo de proyecto'));
        $this->assertIsInt($RepositorioTipoProyecto->insertar('proyecto de investigación'));
    }

    public function test_editar_registro_de_tipo_de_proyecto()
    {
        $RepositorioTipoProyecto=new RepositorioTipoProyecto();
        $this->assertEquals($RepositorioTipoProyecto->editar(1,'nuevo tipo de proyecto 2'),1);
    }

    public function test_eliminar_registro_de_tipo_de_proyecto()
    {
        $RepositorioTipoProyecto=new RepositorioTipoProyecto();
        $this->assertEquals($RepositorioTipoProyecto->eliminar(1),1);
    }


}
