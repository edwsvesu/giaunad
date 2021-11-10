<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioUsuarioHasSemillero;
use Tests\TestCase;

class RepositorioUsuarioHasSemilleroTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_realizar_insercion_de_varios_registros_en_la_tabla_UsuarioHasSemillero()
    {
        $datos=[];
        $datos[]=array(
            'usuario_id'=>3,
            'semillero_id'=>1
        );
        $datos[]=array(
            'usuario_id'=>4,
            'semillero_id'=>1
        );
        $datos[]=array(
            'usuario_id'=>2,
            'semillero_id'=>1
        );
        $RepositorioUsuarioHasSemillero=new RepositorioUsuarioHasSemillero();
        $this->assertTrue($RepositorioUsuarioHasSemillero->insertarVarios($datos));
    }

    public function test_eliminar_registro_en_la_tabla_UsuarioHasSemillero()
    {
        $RepositorioUsuarioHasSemillero=new RepositorioUsuarioHasSemillero();
        $this->assertEquals($RepositorioUsuarioHasSemillero->eliminar(2,1),1);
    }
}
