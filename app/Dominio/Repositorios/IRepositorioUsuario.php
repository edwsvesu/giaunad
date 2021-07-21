<?php
namespace App\Dominio\Repositorios;

interface IRepositorioUsuario{
    public function insertar(array $datos);
    public function buscarPorDocumento(string $numero_documento);
}
