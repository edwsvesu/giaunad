<?php
namespace App\Dominio\Servicios\Proyectos;

interface IReporteServicio{
	public function getProyectosVigentes();
	public function getProyectosFinalizados();
	public function getIntegrantesProyecto(int $proyecto_id);
	public function getIntegranteProyecto(string $proyecto_cod,int $usuario_id);
	public function getProyectosDeUsuario(int $usuario_id);
	public function getInformacionGeneralProyecto(string $codigo);
}