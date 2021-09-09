<?php
namespace App\Dominio\Servicios\Proyectos;

interface IReporteServicio{
	public function getProyectosVigentes();
	public function getProyectosFinalizados();
	public function getProyectosDeUsuario(string $numero_documento);
	public function getIntegrantesProyecto(int $proyecto_id);
	public function getIntegranteProyecto(array $datos);
}