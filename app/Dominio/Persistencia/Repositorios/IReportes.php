<?php
namespace App\Dominio\Persistencia\Repositorios;

interface IReportes{
	public function getIntegrantesDelGrupo();
	public function getProyectosVigentes();
	public function getProyectosFinalizados();
	public function getProyectosDeUsuario(int $usuario_id);
	public function getInformacionGeneralProyecto(string $codigo);
	public function getIntegrantesDeProyecto(int $proyecto_id);
	public function getIntegranteDeProyecto(string $proyecto_cod,int $usuario_id);
	public function getInforme(int $informe_id,string $cod_proyecto);
	public function getDatosPersonalesUsuario(int $usuario_id);
	public function getTodaFormacionAcademicaPorUsuario(int $usuario_id);
	public function getFormacionAcademicaPorUsuario(int $formacion_id,int $usuario_id);
}