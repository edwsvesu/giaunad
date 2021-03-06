<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioInforme;
use phpDocumentor\Reflection\Types\This;
use Tests\TestCase;

class RepositorioInformeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insertar_registro_de_informe_de_proyecto()
    {
        $informe=array(
            'titulo'=>"primer informe de proyecto",
            'descripcion'=>"subir entrega de primer informe de proyecto",
            'fecha_limite'=>null,
            'fecha_entrega'=>null,
            'proyecto_id'=>1
        );
        $RepositorioInforme=new RepositorioInforme();
        $this->assertIsInt($RepositorioInforme->insertar($informe));
    }

    public function test_insertar_registro_de_segundo_informe_de_proyecto()
    {
        $informe=array(
            'titulo'=>"tercer informe de proyecto",
            'descripcion'=>"subir entrega de tercer informe de proyecto",
            'fecha_limite'=>null,
            'fecha_entrega'=>null,
            'proyecto_id'=>1
        );
        $RepositorioInforme=new RepositorioInforme();
        $this->assertIsInt($RepositorioInforme->insertar($informe));
    }

    public function test_actualizar_fecha_entrega_de_informe()
    {
        $RepositorioInforme=new RepositorioInforme();
        $this->assertEquals($RepositorioInforme->actualizarFechaEntrega(1,'2021-12-16'),1);
    }

    public function test_editar_registro_de_informe()
    {
        $informe=array(
            'titulo'=>"primer informe de proyecto",
            'descripcion'=>"subir entrega del primer informe del proyecto de investigación",
            'fecha_limite'=>'2021-12-20',
            'id'=>1
        );
        $RepositorioInforme=new RepositorioInforme();
        $this->assertEquals($RepositorioInforme->editar($informe),1);
    }

    public function test_eliminar_registro_de_informe()
    {
        $RepositorioInforme=new RepositorioInforme();
        $this->assertEquals($RepositorioInforme->eliminar(2),1);
    }
}
