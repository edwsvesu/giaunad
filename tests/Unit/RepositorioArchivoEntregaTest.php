<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioArchivoEntrega;
use Tests\TestCase;

class RepositorioArchivoEntregaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insertar_nuevo_registro_de_archivo_de_entrega_de_actividad()
    {
        $archivo=array(
            'nombre'=>'entrega1.docx',
            'ruta'=>'entregas/archivo/entrega1.docx',
            'entrega_id'=>1
        );
        $RepositorioArchivoEntrega=new RepositorioArchivoEntrega();
        $this->assertTrue($RepositorioArchivoEntrega->insertar($archivo));
    }

    public function test_insertar_segundo_registro_de_archivo_de_entrega_de_actividad()
    {
        $archivo=array(
            'nombre'=>'entrega2.docx',
            'ruta'=>'entregas/archivo/entrega2.docx',
            'entrega_id'=>1
        );
        $RepositorioArchivoEntrega=new RepositorioArchivoEntrega();
        $this->assertTrue($RepositorioArchivoEntrega->insertar($archivo));
    }

    public function test_eliminar_registro_de_archivo_de_entrega()
    {
        $RepositorioArchivoEntrega=new RepositorioArchivoEntrega();
        $this->assertEquals($RepositorioArchivoEntrega->eliminar(1,'entregas/archivo/entrega2.docx'),1);
    }

}
