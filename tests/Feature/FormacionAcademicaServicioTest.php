<?php

namespace Tests\Feature;

use App\Persistencia\Repositorios\Reportes;
use App\Persistencia\Repositorios\RepositorioFormacionAcademica;
use App\Persistencia\Repositorios\RepositorioInstitucion;
use App\Persistencia\Repositorios\RepositorioNivel;
use App\Servicios\Usuarios\Curriculum\FormacionAcademicaServicio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormacionAcademicaServicioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_crear_nueva_formacion_academica_de_usuario()
    {
        $formacion=array(
            'titulo'=>'Ingenieria de sistemas',
            'nivel_id'=>9,
            'institucion_id'=>1,
            'intensidad'=>56,
            'fecha_inicio'=>'2016-02-05'
        );
        $servicio=new FormacionAcademicaServicio(new Reportes,new RepositorioFormacionAcademica,new RepositorioNivel,new RepositorioInstitucion);
        $this->assertTrue($servicio->crearFormacionAcademica($formacion,1));
    }

    public function test_actualizar_informacion_de_formacion_academica_de_usuario()
    {
        $formacion=array(
            'titulo'=>'Ingenieria de sistemas',
            'nivel_id'=>9,
            'institucion_id'=>1,
            'intensidad'=>56,
            'fecha_inicio'=>'2016-02-15',
            'promedio'=>4.3
        );
        $servicio=new FormacionAcademicaServicio(new Reportes,new RepositorioFormacionAcademica,new RepositorioNivel,new RepositorioInstitucion);
        $this->assertEquals($servicio->editarFormacionAcademica($formacion,1),1);
    }

    public function test_eliminar_informacion_de_formacion_academica_de_usuario()
    {
        $formacion=array(
            'formacion_id_del'=>2
        );
        $servicio=new FormacionAcademicaServicio(new Reportes,new RepositorioFormacionAcademica,new RepositorioNivel,new RepositorioInstitucion);
        $this->assertEquals($servicio->eliminar($formacion,1),1);
    }
}
