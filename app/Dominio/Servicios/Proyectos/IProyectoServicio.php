<?php
namespace App\Dominio\Servicios\Proyectos;
interface IProyectoServicio{
	public function getTodosTiposDeProyectos();
	public function registrarNuevoProyecto(array $datos,int $usuario_rol);
	public function proyectoEstaRegistrado(string $codigo);
	public function getDocumentos(int $proyecto_id);
	public function subirDocumentos(array $datos,string $proyecto_cod,int $usuario_id,int $usuario_rol);
	public function descargarDocumento(string $ruta,string $nombre);
	public function proyectoEstaRegistradoPorId(int $id);
	public function borrarDocumento(array $datos,string $proyecto_cod,int $usuario_id,int $usuario_rol);
	public function getIntegrantesProyecto(int $proyecto_id);
	public function setIntegranteProyecto(array $datos,string $proyecto_cod,int $usuario_id,int $usuario_rol);
	public function crearTipoProyecto(array $datos,$usuario_rol);
	public function editarTipoProyecto(array $datos,int $usuario_rol);
	public function eliminarTipoProyecto(array $datos,int $usuario_rol);
	public function usuarioEsIntegranteDeProyecto(int $usuario_id,int $proyecto_id);
	public function getIdProyecto(string $codigo);
}