<?php
namespace App\Dominio\Servicios\Usuarios;
interface IUsuarioServicio{
	public function getUsuariosNoVerificados();
	public function rechazarSolicitudIngreso(array $datos);
	public function aceptarSolicitudIngreso(array $datos);
	public function getTodosRoles();
	public function actualizarRol(array $datos);
	public function getUsuariosAptosComoLideres();
}