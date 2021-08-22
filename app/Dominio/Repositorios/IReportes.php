<?php
namespace App\Dominio\Repositorios;

interface IReportes{
	public function getIntegrantesDelGrupo();
	public function getProyectosVigentes();
	public function getProyectosFinalizados();
}