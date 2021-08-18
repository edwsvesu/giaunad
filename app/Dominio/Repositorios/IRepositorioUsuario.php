<?php
namespace App\Dominio\Repositorios;

interface IRepositorioUsuario{
    public function insertar(array $datos);
    public function buscarPorDocumento(string $numero_documento);
    public function eliminar(string $numero_documento);
    public function getUsuariosNoVerificados();
    public function actualizarVerificado(string $numero_documento,int $valor);
    public function actualizarRol(string $numero_documento,int $rol_id);
}
