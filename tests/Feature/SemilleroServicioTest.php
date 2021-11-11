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

    public function test_intentar_crear_semillero_con_informacion_no_valida()
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

    public function test_validar_que_un_usuario_es_lider_de_un_semillero()
    {
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertTrue($servicio->usuarioEsLiderDeSemillero(3,2));
    }

    public function test_validar_que_un_usuario_no_es_lider_de_un_semillero()
    {
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertFalse($servicio->usuarioEsLiderDeSemillero(3,4));
    }

    public function test_validar_que_un_usuario_es_coordinador_de_un_semillero()
    {
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertTrue($servicio->usuarioEsCoordinadorDeSemillero(3,1));
    }

    public function test_validar_que_un_usuario_no_es_coordinador_de_un_semillero()
    {
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertFalse($servicio->usuarioEsCoordinadorDeSemillero(3,6));
    }

    public function test_agregar_semillleristas_a_semillero_con_respuesta_falsa()
    {
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $semillero=array(
            'nombre'=>'semillero de prueba',
            'fecha_inicio'=>'2011-04-13',
            'coordinador_id'=>1,
            'lider_id'=>2
        );
        $codigo=$servicio->crear($semillero,1);
        $semilleristas[]=array(
            'usuario_id'=>6
        );
        $this->assertFalse($servicio->agregarSemilleristas($semilleristas,$codigo,1,1));
    }

    public function test_crear_actividad_de_semillero()
    {
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $codigo="lp-20210312";
        $actividad=array(
            'titulo'=>'crear una pagina web para presentar informacion academica',
            'fecha_entrega'=>null,
            'instrucciones'=>'Realiar una pagina web estatica para presentar informacion acerca de su perfil academico'
        );
        $this->assertIsArray($servicio->crearActividad($actividad,$codigo,1,1));
    }

    public function test_intentar_crear_actividad_de_semillero_con_informacion_no_valida()
    {
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $codigo="lp-20210312";
        $actividad=array(
            'fecha_entrega'=>null,
            'instrucciones'=>null
        );
        $this->assertFalse($servicio->crearActividad($actividad,$codigo,1,1));
    }

    public function test_actualizar_informacion_de_actividad()
    {
        $actividad=array(
            'titulo'=>'entrega de primer prototipo de la aplicacion WEB de GIAUNAD',
            'fecha_entrega'=>'2021-11-13',
            'instrucciones'=>'entregar primer prototipo'
        );
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertEquals($servicio->editarActividad($actividad,'lp-20210312','eppdg-343433',1,1),1);
    }

    public function test_actualizar_informacion_de_actividad_con_informacion_no_valida()
    {
        $actividad=array(
            'instrucciones'=>'entregar primer prototipo'
        );
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertFalse($servicio->editarActividad($actividad,'lp-20210312','eppdg-343433',1,1));
    }

    public function test_crear_entrega_de_actividad_si_aun_no_existe()
    {
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertTrue($servicio->crearEntregaSiNoExiste('lp-20210312','eppdg-343433',3));
    }

    public function test_eliminar_archivo_de_entrega_de_actividad()
    {
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertTrue($servicio->eliminarArchivoEntrega('lp-20210312','eppdg-343433',3,'entregas/archivo/entrega1.docx'));  
    }

    public function test_quitar_integrante_semillerista_de_semillero()
    {
        $datos=array(
            'usuario_id'=>4
        );
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertEquals($servicio->quitarSemillerista($datos,'lp-20210312'),1);
    }

    public function test_eliminar_actividad_de_semillero()
    {
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertEquals($servicio->eliminarActividad('lp-20210312','eppdg-343433',1,1),1);
    }

    public function test_eliminar_semillero_permanentemente()
    {
        $servicio=new SemilleroServicio(new RepositorioSemillero,new Reportes,new RepositorioUsuarioHasSemillero,new RepositorioActividad,new RepositorioArchivoEntrega,new RepositorioEntrega);
        $this->assertEquals($servicio->eliminarSemillero('lp-20210312',1),1);
    }

}
