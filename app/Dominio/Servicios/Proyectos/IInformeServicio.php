<?php

namespace App\Dominio\Servicios\Proyectos;

interface IInformeServicio{
	public function crear(array $datos,$proyecto_cod,$usuario_id);
	public function getInformes(int $proyecto_id);
	public function getInforme(int $informe_id,string $cod_proyecto);
	public function realizarEntrega(array $datos);
	public function informeEstaRegistrado(int $informe_id);
	public function getArchivos(int $informe_id);
	public function descargarArchivo(string $ruta,string $nombre);
	public function proyectoEstaRegistrado(int $proyecto_id);
	public function proyectoEstaRegistradoPorCodigo(string $proyecto_cod);
	public function getIdProyecto(string $codigo);
	public function usuarioEsLiderDeProyecto(int $proyecto_id,int $usuario_id);
}