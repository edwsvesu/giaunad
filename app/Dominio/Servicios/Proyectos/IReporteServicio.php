<?php
namespace App\Dominio\Servicios\Proyectos;

interface IReporteServicio{
	public function getProyectosVigentes();
	public function getProyectosFinalizados();
	public function getProyectosDeUsuario(string $numero_documento);
}