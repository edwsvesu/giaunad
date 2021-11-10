<?php

namespace Tests\Feature;

use App\Persistencia\Repositorios\RepositorioUsuario;
use App\Servicios\Usuarios\RegistrarseServicio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrarseServicioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_realizar_un_nuevo_registro_de_usuario()
    {
        $usuario=array(
            'nombres'=>'Juan Jose',
            'apellidos'=>"Amaya Amaya",
            'numero_documento'=>'99121607243',
            'correo_principal'=>'juan@gmail.com',
            'correo_secundario'=>'juanjose@gmail.com',
            'clave'=>'1234'
        );
        $servicio=new RegistrarseServicio(new RepositorioUsuario);
        $salida=array('accion'=>'true','mensaje'=>'Debes esperar hasta que el administrador te permita ingresar al sistema');
        $this->assertEquals($servicio->registrarse($usuario),$salida);
    }

    public function test_realizar_un_segundo_sin_correo_secundario_registro_de_usuario()
    {
        $usuario=array(
            'nombres'=>'Gissel Mariana',
            'apellidos'=>"Avila Carrascal",
            'numero_documento'=>'9985653358',
            'correo_principal'=>'mari@gmail.com',
            'correo_secundario'=>null,
            'clave'=>'1234'
        );
        $servicio=new RegistrarseServicio(new RepositorioUsuario);
        $salida=array('accion'=>'true','mensaje'=>'Debes esperar hasta que el administrador te permita ingresar al sistema');
        $this->assertEquals($servicio->registrarse($usuario),$salida);
    }

    public function test_realizar_un_nuevo_registro_de_usuario_ya_existente()
    {
        $usuario=array(
            'nombres'=>'Juan Jose',
            'apellidos'=>"Amaya Amaya",
            'numero_documento'=>'99121607243',
            'correo_principal'=>'juan@gmail.com',
            'correo_secundario'=>'juanjose@gmail.com',
            'clave'=>'1234'
        );
        $servicio=new RegistrarseServicio(new RepositorioUsuario);
        $salida=array('accion'=>'false','mensaje'=>'Ya existe un registro con este numero de documento');
        $this->assertEquals($servicio->registrarse($usuario),$salida);
    }

    public function test_realizar_un_nuevo_registro_de_usuario_con_informacion_no_valida()
    {
        $usuario=array(
            'nombres'=>'',
            'apellidos'=>"Amaya Amaya",
            'numero_documento'=>'43447887978',
            'correo_principal'=>'juanmail.com',
            'correo_secundario'=>'juanjose@gmail.com',
            'clave'=>'1234'
        );
        $servicio=new RegistrarseServicio(new RepositorioUsuario);
        $salida=array('accion'=>'false','mensaje'=>'Información no válida');
        $this->assertEquals($servicio->registrarse($usuario),$salida);
    }
}
