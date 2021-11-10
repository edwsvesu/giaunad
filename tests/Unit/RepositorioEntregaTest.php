<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioEntrega;
use Tests\TestCase;

class RepositorioEntregaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insertar_nuevo_registro_de_entrega_de_actividad()
    {
        $entrega=array(
            'actividad_id'=>1,
            'usuario_id'=>3
        );
        $RepositorioEntrega=new RepositorioEntrega();
        $this->assertTrue($RepositorioEntrega->insertar($entrega));
    }

    public function test_insertar_segundo_registro_de_entrega_de_actividad()
    {
        $entrega=array(
            'actividad_id'=>1,
            'usuario_id'=>4
        );
        $RepositorioEntrega=new RepositorioEntrega();
        $this->assertTrue($RepositorioEntrega->insertar($entrega));
    }
}
