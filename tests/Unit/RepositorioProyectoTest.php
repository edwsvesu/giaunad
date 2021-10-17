<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioProyecto;
use Tests\TestCase;

class RepositorioProyectoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_realizar_registro_de_nuevo_proyecto()
    {
        $proyecto=array(
            'titulo'=>'Aplicacion WEB para el grupo de investigacion GIAUNAD',
            'fecha_inicio'=>'2021-10-05',
            'fecha_fin'=>null,
            'codigo'=>'AWGIGIAUNAD',
            'tipo_proyecto_id'=>2,
            'documentos'=>null,
            'lidera'=>1
        );
        $RepositorioProyecto=new RepositorioProyecto($proyecto);
        $this->assertNull($RepositorioProyecto->insertar($proyecto));
    }
}
