<?php

namespace Tests\Unit;

use App\Dominio\Modelos\Usuario;
use Tests\TestCase;

class UsuarioTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_verificar_validez_de_instancia_de_objeto_usuario_para_registro_con_datos_no_validos()
    {
        $usuario=new Usuario();
        $this->assertTrue($usuario->validez()->fails());
    }

    public function test_verificar_validez_de_instancia_de_objeto_usuario_para_registro_con_datos_validos()
    {
        $usuario=new Usuario();
        $usuario->setNombres('edwin sneider');
        $usuario->setApellidos('velandia suarez');
        $usuario->setNumero_documento('123454333');
        $this->assertFalse($usuario->validez()->fails());
    }
}
