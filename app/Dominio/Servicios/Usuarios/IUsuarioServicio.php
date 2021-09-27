<?php
namespace App\Dominio\Servicios\Usuarios;
interface IUsuarioServicio{
	public function getUsuariosNoVerificados();
	public function rechazarSolicitudIngreso(array $datos,int $usuario_rol);
	public function aceptarSolicitudIngreso(array $datos,int $usuario_rol);
	public function getTodosRoles();
	public function actualizarRol(array $datos,int $usuario_rol);
	public function getUsuariosAptosComoLideres();
}