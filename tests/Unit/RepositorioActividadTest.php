<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioActividad;
use Tests\TestCase;

class RepositorioActividadTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insertar_nuevo_registro_de_actividad()
    {
        $actividad=array(
            'codigo'=>'eppdg-343433',
            'titulo'=>'entrega de primer prototipo de GIAUNAD',
            'fecha_entrega'=>null,
            'instrucciones'=>null,
            'semillero_id'=>1
        );
        $RepositorioActividad=new RepositorioActividad();
        $this->assertTrue($RepositorioActividad->insertar($actividad));
    }

    public function test_insertar_segundo_registro_de_actividad()
    {
        $actividad=array(
            'codigo'=>'dccp-58940',
            'titulo'=>'desarrollar calculadora con python',
            'fecha_entrega'=>'2021-02-07',
            'instrucciones'=>'utilizando python, realice una calculadora básica',
            'semillero_id'=>1
        );
        $RepositorioActividad=new RepositorioActividad();
        $this->assertTrue($RepositorioActividad->insertar($actividad));
    }

    public function test_editar_registro_de_actividad()
    {
        $actividad=array(
            'id'=>1,
            'titulo'=>'entrega de primer prototipo del software de GIAUNAD',
            'fecha_entrega'=>'2022-02-05',
            'instrucciones'=>'adjuntar la entrega del primer prototipo de software'
        );
        $RepositorioActividad=new RepositorioActividad();
        $this->assertEquals($RepositorioActividad->editar($actividad),1);
    }

    public function test_eliminar_registro_de_actividad()
    {
        $RepositorioActividad=new RepositorioActividad();
        $this->assertEquals($RepositorioActividad->eliminar(2),1);
    }
}
