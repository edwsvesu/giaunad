<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Persistencia\Repositorios\RepositorioDocumento;
use App\Persistencia\Repositorios\RepositorioProyecto;
use App\Persistencia\Repositorios\RepositorioTipoProyecto;
use App\Persistencia\Repositorios\RepositorioUsuario;
use App\Persistencia\Repositorios\RepositorioUsuarioHasProyecto;
use App\Servicios\Proyectos\ProyectoServicio;
use Tests\TestCase;

class ProyectoServicioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_registrar_un_nuevo_proyecto()
    {
        $proyecto=array(
            'titulo'=>'Aplicacion WEB para gestion y control de inventario',
            'fecha_inicio'=>'2021-10-05',
            'fecha_fin'=>'2023-02-01',
            'codigo'=>'AWGIWEBSOCK',
            'tipo_proyecto_id'=>2,
            'documentos'=>null,
            'lidera'=>1
        );
        $servicio=new ProyectoServicio(new RepositorioTipoProyecto,new RepositorioProyecto,new RepositorioDocumento,new RepositorioUsuario,new RepositorioUsuarioHasProyecto);
        $this->assertTrue($servicio->registrarNuevoProyecto($proyecto,1));
    }

    public function test_registrar_un_nuevo_proyecto_ya_existente()
    {
        $proyecto=array(
            'titulo'=>'Aplicacion WEB para gestion y control de inventario',
            'fecha_inicio'=>'2021-10-05',
            'fecha_fin'=>'2023-02-01',
            'codigo'=>'AWGIWEBSOCK',
            'tipo_proyecto_id'=>2,
            'documentos'=>null,
            'lidera'=>1
        );
        $servicio=new ProyectoServicio(new RepositorioTipoProyecto,new RepositorioProyecto,new RepositorioDocumento,new RepositorioUsuario,new RepositorioUsuarioHasProyecto);
        $this->assertFalse($servicio->registrarNuevoProyecto($proyecto,1));
    }

    public function test_registrar_un_nuevo_proyecto_con_informacion_no_valida()
    {
        $proyecto=array(
            'titulo'=>null,
            'fecha_inicio'=>'2021-10-05',
            'fecha_fin'=>'2023-02-01',
            'codigo'=>'AA23IWEBSOCK',
            'tipo_proyecto_id'=>2,
            'documentos'=>null,
            'lidera'=>1
        );
        $servicio=new ProyectoServicio(new RepositorioTipoProyecto,new RepositorioProyecto,new RepositorioDocumento,new RepositorioUsuario,new RepositorioUsuarioHasProyecto);
        $this->assertFalse($servicio->registrarNuevoProyecto($proyecto,1));
    }
}
