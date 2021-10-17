<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioFormacionAcademica;
use Tests\TestCase;

class RepositorioFormacionAcademicaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insertar_nuevo_registro_de_formacion_academica()
    {
        $formacion=array(
            'titulo'=>'Ingenieria de sistemas',
            'intensidad'=>30,
            'fecha_inicio'=>'2016-02-05',
            'fecha_fin'=>null,
            'promedio'=>4.6,
            'usuario_id'=>1,
            'nivel_id'=>1,
            'institucion_id'=>1
        );
        $RepositorioFormacionAcademica=new RepositorioFormacionAcademica();
        $this->assertTrue($RepositorioFormacionAcademica->insertar($formacion));
    }

    public function test_editar_registro_de_formacion_academica()
    {
        $formacion=array(
            'titulo'=>'Ingenieria de sistemas informaticos',
            'intensidad'=>30,
            'fecha_inicio'=>'2016-02-15',
            'fecha_fin'=>null,
            'promedio'=>4.3,
            'usuario_id'=>1,
            'nivel_id'=>1,
            'institucion_id'=>1,
            'id'=>1
        );
        $RepositorioFormacionAcademica=new RepositorioFormacionAcademica();
        $this->assertEquals($RepositorioFormacionAcademica->editar($formacion),1);
    }

    public function test_eliminar_registro_de_formacion_academica()
    {
        $RepositorioFormacionAcademica=new RepositorioFormacionAcademica();
        $this->assertEquals($RepositorioFormacionAcademica->eliminar(1,1),1);
    }
}
