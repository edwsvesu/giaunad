<?php
namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioUsuario{
    public function insertar(array $datos);
    public function buscarPorDocumento(string $numero_documento);
    public function eliminar(string $numero_documento);
    public function getUsuariosNoVerificados();
    public function actualizarVerificado(string $numero_documento,int $valor);
    public function actualizarRol(string $numero_documento,int $rol_id);
    public function getUsuariosAptosComoLideres();
    public function getUsuariosAptosComoIntegrantesProyecto(int $proyecto_id);
    public function editar(array $datos);
    public function getFoto(int $id);
}
