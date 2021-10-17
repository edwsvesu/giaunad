<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioFormacionIdioma;
use Tests\TestCase;

class RepositorioFormacionIdiomaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insertar_nuevo_registro_de_formacion_de_idioma()
    {
        $formacion=array(
            'lectura'=>'aceptable',
            'escritura'=>'aceptable',
            'habla'=>'aceptable',
            'escucha'=>'aceptable',
            'usuario_id'=>1,
            'idioma_id'=>1
        );
        $RepositorioFormacionIdioma=new RepositorioFormacionIdioma();
        $this->assertTrue($RepositorioFormacionIdioma->insertar($formacion));
    }

    public function test_editar_registro_formacion_idioma_por_id_usuario()
    {
        $formacion=array(
            'lectura'=>'aceptable',
            'escritura'=>'bueno',
            'habla'=>'aceptable',
            'escucha'=>'bueno',
            'usuario_id'=>1,
            'id'=>1
        );
        $RepositorioFormacionIdioma=new RepositorioFormacionIdioma();
        $this->assertEquals($RepositorioFormacionIdioma->editarPorUsuario($formacion),1);
    }
}
