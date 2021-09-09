<?php
namespace App\Dominio\Persistencia\Repositorios;

interface IReportes{
	public function getIntegrantesDelGrupo();
	public function getProyectosVigentes();
	public function getProyectosFinalizados();
	public function getProyectosDeUsuario(string $numero_documento);
	public function getInformacionGeneralProyecto(string $codigo);
	public function getIntegrantesDeProyecto(int $proyecto_id);
	public function getIntegranteDeProyecto(int $proyecto_id,int $usuario_id);
	public function getInforme(int $informe_id,string $cod_proyecto);
	public function getDatosPersonalesUsuario(string $numero_documento);
}