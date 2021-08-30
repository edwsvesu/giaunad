<?php
namespace App\Dominio\Persistencia\Repositorios;

interface IReportes{
	public function getIntegrantesDelGrupo();
	public function getProyectosVigentes();
	public function getProyectosFinalizados();
	public function getProyectosDeUsuario(string $numero_documento);
	public function getInformacionGeneralProyecto(string $codigo);
}