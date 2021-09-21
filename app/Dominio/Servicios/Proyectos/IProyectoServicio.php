<?php
namespace App\Dominio\Servicios\Proyectos;
interface IProyectoServicio{
	public function getTodosTiposDeProyectos();
	public function registrarNuevoProyecto(array $datos);
	public function proyectoEstaRegistrado(string $codigo);
	public function getDocumentos(int $proyecto_id);
	public function subirDocumentos(array $datos,string $proyecto_cod,int $usuario_id);
	public function descargarDocumento(string $ruta,string $nombre);
	public function proyectoEstaRegistradoPorId(int $id);
	public function borrarDocumento(array $datos,string $proyecto_cod,int $usuario_id);
	public function getIntegrantesProyecto(int $proyecto_id);
	public function setIntegranteProyecto(array $datos,string $proyecto_cod,int $usuario_id);
	public function crearTipoProyecto(array $datos);
	public function editarTipoProyecto(array $datos);
	public function eliminarTipoProyecto(array $datos);
	public function usuarioEsIntegranteDeProyecto(int $usuario_id,int $proyecto_id);
	public function getIdProyecto(string $codigo);
}