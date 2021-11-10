<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioSemillero;
use Tests\TestCase;

class RepositorioSemilleroTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insertar_nuevo_registro_de_semillero()
    {
        $semillero=array(
            'codigo'=>'lp-20210312',
            'nombre'=>'logica de programación',
            'fecha_inicio'=>'2018-12-12',
            'coordinador_id'=>1,
            'lider_id'=>2
        );
        $RepositorioSemillero=new RepositorioSemillero();
        $this->assertTrue($RepositorioSemillero->insertar($semillero));
    }

    public function test_insertar_segundo_registro_de_semillero()
    {
        $semillero=array(
            'codigo'=>'rei-20150617',
            'nombre'=>'redes e internet',
            'fecha_inicio'=>'2015-02-11',
            'coordinador_id'=>1,
            'lider_id'=>2
        );
        $RepositorioSemillero=new RepositorioSemillero();
        $this->assertTrue($RepositorioSemillero->insertar($semillero));
    }

    public function test_editar_registro_de_semillero()
    {
        $semillero=array(
            'nombre'=>'semillero de logica de programación',
            'coordinador_id'=>1,
            'lider_id'=>2,
            'fecha_inicio'=>'2018-06-12',
            'id'=>1
        );
        $RepositorioSemillero=new RepositorioSemillero();
        $this->assertEquals($RepositorioSemillero->editar($semillero),1);
    }

    public function test_eliminar_segundo_registro_de_semillero()
    {
        $RepositorioSemillero=new RepositorioSemillero();
        $this->assertEquals($RepositorioSemillero->eliminar(2),1);
    }
}
