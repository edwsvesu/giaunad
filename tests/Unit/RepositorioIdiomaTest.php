<?php

namespace Tests\Unit;

use App\Persistencia\Repositorios\RepositorioIdioma;
use Tests\TestCase;

class RepositorioIdiomaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_insertar_registro_de_idioma()
    {
        $RepositorioIdioma=new RepositorioIdioma();
        $this->assertTrue($RepositorioIdioma->insertar('ingles'));
    }

    public function test_insertar_segundo_registro_de_idioma()
    {
        $RepositorioIdioma=new RepositorioIdioma();
        $this->assertTrue($RepositorioIdioma->insertar('frances'));
    }
}
