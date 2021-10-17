<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioUsuarioHasProyecto;
use Tests\TestCase;

class RepositorioUsuarioHasProyectoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insertar_rgistro_en_UsuarioHasProyecto()
    {
        $RepositorioUsuarioHasProyecto=new RepositorioUsuarioHasProyecto();
        $datos=array(
            'proyecto_id'=>1,
            'usuario_id'=>2
        );
        $this->assertTrue($RepositorioUsuarioHasProyecto->insertar($datos));
    }
}
