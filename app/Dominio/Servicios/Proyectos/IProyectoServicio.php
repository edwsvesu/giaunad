<?php

namespace App\Dominio\Servicios\Proyectos;

interface IProyectoServicio{
	public function getTodosTiposDeProyectos();
	public function registrarNuevoProyecto(array $datos);
	public function proyectoEstaRegistrado(string $codigo);
	public function getDocumentos(int $proyecto_id);
	public function subirDocumentos(array $datos);
	public function descargarDocumento(string $ruta,string $nombre);
	public function proyectoEstaRegistradoPorId(int $id);
	public function borrarDocumento(array $datos);
	public function getIntegrantesProyecto(int $proyecto_id);
	public function setIntegranteProyecto(array $datos);
}