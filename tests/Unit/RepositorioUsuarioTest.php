<?php

namespace Tests\Unit;

use App\Dominio\Persistencia\Repositorios\IRepositorioUsuario;
use App\Persistencia\Repositorios\RepositorioUsuario;
use Tests\TestCase;

class RepositorioUsuarioTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_realizar_registro_de_usuario()
    {
        $usuario=array(
            'nombres'=>'Jesus alfonso',
            'apellidos'=>"Carrascal Suarez",
            'numero_documento'=>'123456789',
            'correo_principal'=>'jecasu@gmail.com',
            'correo_secundario'=>'jecasu2@gmail.com',
            'clave'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        );
        $repositorioUsuario=new RepositorioUsuario();
        $this->assertTrue($repositorioUsuario->insertar($usuario));
    }

    public function test_realizar_registro_de_segundo_usuario()
    {
        $usuario=array(
            'nombres'=>'Edwin',
            'apellidos'=>"Velandia",
            'numero_documento'=>'4343243244',
            'correo_principal'=>'evelsua@gmail.com',
            'correo_secundario'=>'edwin123@gmail.com',
            'clave'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        );
        $repositorioUsuario=new RepositorioUsuario();
        $this->assertTrue($repositorioUsuario->insertar($usuario));
    }

    public function test_realizar_registro_de_tercer_usuario()
    {
        $usuario=array(
            'nombres'=>'Naian Valentina',
            'apellidos'=>"Rosales Caceres",
            'numero_documento'=>'125255458',
            'correo_principal'=>'naian123@gmail.com',
            'correo_secundario'=>'naian@gmail.com',
            'clave'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        );
        $repositorioUsuario=new RepositorioUsuario();
        $this->assertTrue($repositorioUsuario->insertar($usuario));
    }

    public function test_realizar_registro_de_cuarto_usuario()
    {
        $usuario=array(
            'nombres'=>'Santiago',
            'apellidos'=>"Sierra Rodriguez",
            'numero_documento'=>'106983347',
            'correo_principal'=>'sierra123@gmail.com',
            'correo_secundario'=>'santi@gmail.com',
            'clave'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        );
        $repositorioUsuario=new RepositorioUsuario();
        $this->assertTrue($repositorioUsuario->insertar($usuario));
    }

    public function test_realizar_registro_de_quinto_usuario()
    {
        $usuario=array(
            'nombres'=>'desconocido',
            'apellidos'=>"desconocido",
            'numero_documento'=>'121212',
            'correo_principal'=>'desc@gmail.com',
            'correo_secundario'=>'desc123@gmail.com',
            'clave'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        );
        $repositorioUsuario=new RepositorioUsuario();
        $this->assertTrue($repositorioUsuario->insertar($usuario));
    }

    public function test_actualizar_el_estado_verificado_del_registro()
    {
        $repositorioUsuario=new RepositorioUsuario();
        $this->assertEquals($repositorioUsuario->actualizarVerificado('123456789',1),1);
    }

    public function test_actualizar_el_estado_verificado_del_segundo_registro_de_usuario()
    {
        $repositorioUsuario=new RepositorioUsuario();
        $this->assertEquals($repositorioUsuario->actualizarVerificado('4343243244',1),1);
    }

    public function test_actualizar_rol_de_un_registro_de_usuario()
    {
        $repositorioUsuario=new RepositorioUsuario();
        $this->assertEquals($repositorioUsuario->actualizarRol('123456789',3),1);
    }

    public function test_editar_registro_de_usuario()
    {
        $repositorioUsuario=new RepositorioUsuario();
        $usuario=array(
            'nombres'=>'Jesus Maria',
            'apellidos'=>"Carrascal Suarez",
            'correo_principal'=>'jemaria@gmail.com',
            'correo_secundario'=>'jesusMa32@gmail.com',
            'foto'=>null,
            'id'=>1
        );
        $this->assertEquals($repositorioUsuario->editar($usuario),1);
    }

    public function test_editar_password_de_registro_de_usuario()
    {
        $repositorioUsuario=new RepositorioUsuario();
        $this->assertEquals($repositorioUsuario->editarPassword('$2y$10$3RfXUNpery0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',4),1);
    }

    public function test_eliminar_registro_de_usuario()
    {
        $repositorioUsuario=new RepositorioUsuario();
        $this->assertEquals($repositorioUsuario->eliminar("121212"),1);
    }
}
