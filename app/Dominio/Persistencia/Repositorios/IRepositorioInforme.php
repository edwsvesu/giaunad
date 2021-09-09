<?php

namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioInforme{
	public function insertar(array $datos);
	public function getInformesPorProyecto(int $proyecto_id);
	public function actualizarFechaEntrega(int $informe_id,string $fecha_entrega);
	public function buscarPorId(int $informe_id);
}