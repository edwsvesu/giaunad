<?php

namespace Tests\Feature;

use App\Persistencia\Repositorios\Reportes;
use App\Persistencia\Repositorios\RepositorioActividad;
use App\Persistencia\Repositorios\RepositorioArchivoEntrega;
use App\Persistencia\Repositorios\RepositorioEntrega;
use App\Persistencia\Repositorios\RepositorioSemillero;
use App\Persistencia\Repositorios\RepositorioUsuarioHasSemillero;
use App\Servicios\Semilleros\SemilleroServicio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SemilleroServicioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_crear_semillero()
    {
        $semillero=array(
            'nombre'=>'tecnicas de expresion escrita y oral',
            'fecha_inicio'=>'2017-08-03',
            'coordinador_id'=>1,
            'lider_id'=>2
        );
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertIsString($servicio->crear($semillero,1));
    }

    public function test_crear_semillero_como_estudiante()
    {
        $semillero=array(
            'nombre'=>'matematicas en linea',
            'fecha_inicio'=>'2019-10-03',
            'coordinador_id'=>1,
            'lider_id'=>2
        );
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertFalse($servicio->crear($semillero,4));
    }

    public function test_crear_semillero_con_informacion_no_valida()
    {
        $semillero=array(
            'fecha_inicio'=>'2017-08-03',
            'coordinador_id'=>1,
            'lider_id'=>2
        );
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertFalse($servicio->crear($semillero,1));
    }

    public function test_editar_informacion_de_semillero_registrado()
    {
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $semillero=array(
            'nombre'=>'Redes de ordenadores',
            'fecha_inicio'=>'2021-08-03',
            'coordinador_id'=>1,
            'lider_id'=>2
        );
        $codigo=$servicio->crear($semillero,1);
        $semillero=array(
            'nombre'=>'Redes de ordenadores II',
            'fecha_inicio'=>'2021-06-01',
            'coordinador_id'=>1,
            'lider_id'=>2
        );
        $this->assertEquals($servicio->editarSemillero($semillero,$codigo,1),1);
    }
}
