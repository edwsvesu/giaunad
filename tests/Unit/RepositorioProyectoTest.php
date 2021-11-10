<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioProyecto;
use Tests\TestCase;

class RepositorioProyectoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_realizar_registro_de_nuevo_proyecto()
    {
        $proyecto=array(
            'titulo'=>'Aplicacion WEB para el grupo de investigacion GIAUNAD',
            'fecha_inicio'=>'2021-10-05',
            'fecha_fin'=>null,
            'codigo'=>'AWGIGIAUNAD',
            'tipo_proyecto_id'=>2,
            'documentos'=>null,
            'lidera'=>1
        );
        $RepositorioProyecto=new RepositorioProyecto();
        $this->assertNull($RepositorioProyecto->insertar($proyecto));
    }

    public function test_realizar_registro_de_segundo_proyecto()
    {
        $proyecto=array(
            'titulo'=>'Aplicación lean manufacturing en la industria colombiana',
            'fecha_inicio'=>'2017-11-06',
            'fecha_fin'=>'2018-11-06',
            'codigo'=>'ALMIC231',
            'tipo_proyecto_id'=>2,
            'documentos'=>null,
            'lidera'=>1
        );
        $RepositorioProyecto=new RepositorioProyecto();
        $this->assertNull($RepositorioProyecto->insertar($proyecto));
    }

    public function test_editar_registro_de_proyecto()
    {
        $proyecto=array(
            'titulo'=>'Aplicación lean manufacturing en la industria colombiana',
            'fecha_inicio'=>'2019-11-06',
            'fecha_fin'=>'2020-11-06',
            'codigo'=>'ALMIC231332',
            'tipo_proyecto_id'=>2,
            'id'=>2
        );
        $RepositorioProyecto=new RepositorioProyecto();
        $this->assertEquals($RepositorioProyecto->editar($proyecto),1);
    }

    public function test_actualizar_atributo_finalizado_de_proyecto()
    {
        $RepositorioProyecto=new RepositorioProyecto();
        $this->assertEquals($RepositorioProyecto->actualizarFinalizado(2,1),1);
    }

    public function test_eliminar_registro_de_proyecto()
    {
        $RepositorioProyecto=new RepositorioProyecto();
        $this->assertEquals($RepositorioProyecto->eliminar(2),1);
    }
}
