<?php

namespace Tests\Feature;

use App\Persistencia\Repositorios\Reportes;
use App\Persistencia\Repositorios\RepositorioArchivoInforme;
use App\Persistencia\Repositorios\RepositorioDocumento;
use App\Persistencia\Repositorios\RepositorioInforme;
use App\Persistencia\Repositorios\RepositorioProyecto;
use App\Persistencia\Repositorios\RepositorioTipoProyecto;
use App\Persistencia\Repositorios\RepositorioUsuario;
use App\Persistencia\Repositorios\RepositorioUsuarioHasProyecto;
use App\Servicios\Proyectos\InformeServicio;
use App\Servicios\Proyectos\ProyectoServicio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InformeServicioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_crear_un_nuevo_informe()
    {
        $informe=array(
            'titulo'=>"segundo informe de proyecto",
            'descripcion'=>"subir entrega de primer informe de proyecto",
            'fecha_limite'=>null,
            'fecha_entrega'=>'2021-12-12'
        );
        $servicio=new InformeServicio(new RepositorioInforme,new Reportes,new RepositorioArchivoInforme,new RepositorioProyecto);
        $this->assertIsArray($servicio->crear($informe,'AWGIGIAUNAD',1,1));
    }

    public function test_crear_un_nuevo_informe_con_informacion_no_valida()
    {
        $informe=array(
            'titulo'=>null,
            'descripcion'=>"subir entrega de primer informe de proyecto",
            'fecha_limite'=>null,
            'fecha_entrega'=>'2021-12-12'
        );
        $servicio=new InformeServicio(new RepositorioInforme,new Reportes,new RepositorioArchivoInforme,new RepositorioProyecto);
        $this->assertFalse($servicio->crear($informe,'AWGIGIAUNAD',1,1));
    }

    public function test_realizar_entrega_de_informe()
    {
        $servicio=new InformeServicio(new RepositorioInforme,new Reportes,new RepositorioArchivoInforme,new RepositorioProyecto);
        $datos=array(
            
        );
        $this->assertTrue($servicio->realizarEntrega($datos,'AWGIGIAUNAD',1,1,1));
    }
}
