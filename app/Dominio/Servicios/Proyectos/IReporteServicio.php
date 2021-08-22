<?php
namespace App\Dominio\Servicios\Proyectos;

interface IReporteServicio{
	public function getProyectosVigentes();
	public function getProyectosFinalizados();
}