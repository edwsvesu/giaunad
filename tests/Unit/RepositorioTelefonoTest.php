<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioTelefono;
use Tests\TestCase;

class RepositorioTelefonoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_insertar_registro_de_telefono()
    {
        $RepositorioTelefono=new RepositorioTelefono();
        $telefono=array(
            'numero'=>'3102506229',
            'descripcion'=>'personal',
            'usuario_id'=>1
        );
        $this->assertIsInt($RepositorioTelefono->insertar($telefono));
        $telefono=array(
            'numero'=>'3134781009',
            'descripcion'=>'oficina',
            'usuario_id'=>1
        );
        $this->assertIsInt($RepositorioTelefono->insertar($telefono));
    }

    public function test_actualizar_varios_registros_de_telefonos()
    {
        $telefonos[]=array(
            'numero'=>'3134781009',
            'descripcion'=>'trabajo',
            'id'=>2,
            'usuario_id'=>1          
        );
        $telefonos[]=array(
            'numero'=>'311478142',
            'descripcion'=>'personal',
            'id'=>1,
            'usuario_id'=>1          
        );
        $RepositorioTelefono=new RepositorioTelefono();
        $this->assertTrue($RepositorioTelefono->actualizarVarios($telefonos));
    }

    public function test_eliminar_registo_de_telefono()
    {
        $RepositorioTelefono=new RepositorioTelefono();
        $this->assertEquals($RepositorioTelefono->eliminar(1,1),1);
    }
}
