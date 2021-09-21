<?php
namespace App\Dominio\Servicios\Usuarios\Curriculum;

interface IDatosPersonalesServicio{
	public function getDatos(int $usuario_id);
	public function eliminarTelefono(array $datos,int $usuario_id);
	public function editarInformacion(array $datos,int $id);
	public function agregarTelefono(array $datos,int $usuario_id);
}