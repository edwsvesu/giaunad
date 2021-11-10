<?php

namespace Tests\Feature;

use App\Persistencia\Repositorios\Reportes;
use App\Persistencia\Repositorios\RepositorioTelefono;
use App\Persistencia\Repositorios\RepositorioUsuario;
use App\Servicios\Usuarios\Curriculum\DatosPersonalesServicio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatosPersonalesServicioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_editar_datos_personales_del_usuario()
    {
        $servicio=new DatosPersonalesServicio(new Reportes,new RepositorioTelefono,new RepositorioUsuario);
        $datos=array(
            'nombres'=>'Jesus Antonio',
            'apellidos'=>"Suarez",
            'correo_principal'=>'jemaria@gmail.com',
            'correo_secundario'=>'jesusMa32@gmail.com',
        );
        $this->assertNull($servicio->editarInformacion($datos,1));
    }

    public function test_agregar_telefono_al_usuario()
    {
        $servicio=new DatosPersonalesServicio(new Reportes,new RepositorioTelefono,new RepositorioUsuario);
        $datos=array(
            'descripcion'=>'trabajo',
            'numero'=>'6545554'
        );
        $this->assertIsInt($servicio->agregarTelefono($datos,1));
    }

    public function test_agregar_segundo_telefono_al_usuario()
    {
        $servicio=new DatosPersonalesServicio(new Reportes,new RepositorioTelefono,new RepositorioUsuario);
        $datos=array(
            'descripcion'=>'casa',
            'numero'=>'658741'
        );
        $this->assertIsInt($servicio->agregarTelefono($datos,1));
    }

    public function test_eliminar_telefono_de_un_usuario()
    {
        $datos['telefono_id']=4;
        $servicio=new DatosPersonalesServicio(new Reportes,new RepositorioTelefono,new RepositorioUsuario);
        $this->assertEquals($servicio->eliminarTelefono($datos,1),1);
    }




}
