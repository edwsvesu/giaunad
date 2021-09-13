<?php
namespace App\Dominio\Servicios\Usuarios\Curriculum;

interface IDatosPersonalesServicio{
	public function getDatos(string $numero_documento);
	public function eliminarTelefono(array $datos,int $usuario_id);
	public function editarInformacion(array $datos,int $id);
	public function agregarTelefono(array $datos,int $usuario_id);
}