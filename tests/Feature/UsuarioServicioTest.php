<?php

namespace Tests\Feature;

use App\Persistencia\Repositorios\RepositorioRol;
use App\Persistencia\Repositorios\RepositorioUsuario;
use App\Servicios\Usuarios\UsuarioServicio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsuarioServicioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_actualizar_rol_de_usuario()
    {
        $datos=array('numero_documento'=>'9985653358','rol_id'=>3);
        $servicio=new UsuarioServicio(new RepositorioUsuario,new RepositorioRol);
        $this->assertEquals($servicio->actualizarRol($datos,1),1);
    }

    public function test_actualizar_rol_de_usuario_con_fallo_por_rol_de_usuario()
    {
        $datos=array('numero_documento'=>'9985653358','rol_id'=>1);
        $servicio=new UsuarioServicio(new RepositorioUsuario,new RepositorioRol);
        $this->assertFalse($servicio->actualizarRol($datos,4));
    }

    public function test_rechazar_solicitud_de_ingreso_al_sistema_para_el_usuario()
    {
        $datos=array('numero_documento'=>'9985653358');
        $servicio=new UsuarioServicio(new RepositorioUsuario,new RepositorioRol);
        $this->assertEquals($servicio->rechazarSolicitudIngreso($datos,1),1);
    }

    public function test_aceptar_solicitud_de_ingreso_al_sistema_para_el_usuario()
    {
        $datos=array('numero_documento'=>'99121607243');
        $servicio=new UsuarioServicio(new RepositorioUsuario,new RepositorioRol);
        $this->assertEquals($servicio->aceptarSolicitudIngreso($datos,1),1);
    }

    public function test_cambiar_password_desde_perfil_de_usuario()
    {
        $datos=array('anterior'=>'1234','nueva'=>'12345');
        $servicio=new UsuarioServicio(new RepositorioUsuario,new RepositorioRol);
        $this->assertEquals($servicio->cambiarContra($datos,'$2y$04$OtFhNJx9AKMsdi.x60kwOu7jI8YEpHPj6Ry4Vjj6HU0EKk.ECyBF2',6),1);
    }

    public function test_cambiar_password_como_administrador()
    {
        $datos=array('nueva'=>'1234567');
        $servicio=new UsuarioServicio(new RepositorioUsuario,new RepositorioRol);
        $this->assertEquals($servicio->cambiarContraTodos($datos,6),1);
    }

    public function test_eliminar_permanentemente_a_usuario_del_sistema()
    {
        $datos=array('numero_documento'=>'125255458');
        $servicio=new UsuarioServicio(new RepositorioUsuario,new RepositorioRol);
        $this->assertEquals($servicio->eliminarUsuario($datos,1),1);
    }
}
