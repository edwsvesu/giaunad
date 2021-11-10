<?php

namespace Tests\Feature;

use App\Persistencia\Repositorios\RepositorioFormacionIdioma;
use App\Persistencia\Repositorios\RepositorioIdioma;
use App\Servicios\Usuarios\Curriculum\FormacionIdiomasServicio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormacionIdiomasServicioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_crear_formacion_de_idioma_de_usuario()
    {
        $formacion=array(
            'lectura'=>'bueno',
            'escritura'=>'bueno',
            'habla'=>'deficiente',
            'escucha'=>'deficiente',
            'idioma_id'=>2
        );
        $servicio=new FormacionIdiomasServicio(new RepositorioFormacionIdioma,new RepositorioIdioma);
        $this->assertTrue($servicio->crearFormacionIdioma($formacion,1));
    }

    public function test_verificar_que_la_formacion_de_idioma_ya_este_registrada_para_el_usuario()
    {
        $servicio=new FormacionIdiomasServicio(new RepositorioFormacionIdioma,new RepositorioIdioma);
        $this->assertTrue($servicio->formacionEstaRegistrada(2,1));
    }

    public function test_editar_formacion_de_idioma_de_usuario()
    {
        $formacion=array(
            'formacion_id'=>2,
            'lectura'=>'Aceptable',
            'escritura'=>'bueno',
            'habla'=>'Aceptable',
            'escucha'=>'Aceptable',
            'idioma_id'=>2
        );
        $servicio=new FormacionIdiomasServicio(new RepositorioFormacionIdioma,new RepositorioIdioma);
        $this->assertEquals($servicio->editarFormacionIdioma($formacion,1),1);   
    }

    public function test_eliminar_formacion_de_idioma_de_usuario()
    {
        $formacion=array('formacion_id_del'=>2);
        $servicio=new FormacionIdiomasServicio(new RepositorioFormacionIdioma,new RepositorioIdioma);
        $this->assertEquals($servicio->eliminarFormacionIdioma($formacion,1),1);
    }

    public function test_verificar_que_la_formacion_de_idioma_ya_no_se_encuentra_registrada_para_el_usuario()
    {
        $servicio=new FormacionIdiomasServicio(new RepositorioFormacionIdioma,new RepositorioIdioma);
        $this->assertFalse($servicio->formacionEstaRegistrada(2,1));
    }

}
