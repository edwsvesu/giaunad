<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Persistencia\Repositorios\IReportes;

class Reportes implements IReportes{
	public function getIntegrantesDelGrupo(){
		$registros=DB::select("select u.nombres,u.apellidos,u.numero_documento,IFNULL(GROUP_CONCAT(CONCAT(t.numero,' | ',t.descripcion) SEPARATOR '; '),'Sin información') as telefonos,u.correo_principal,u.correo_secundario,r.nombre as rol from usuario u join rol r on u.rol_id=r.id left join telefono t on t.usuario_id=u.id where u.verificado=1 GROUP BY u.nombres,u.apellidos,u.numero_documento,u.correo_principal,u.correo_secundario,r.nombre");
		return $registros;
	}

	public function getProyectosVigentes(){
		$registros=DB::select("SELECT t.nombre as tipo,p.titulo,p.codigo,CASE p.finalizado WHEN 0 THEN 'Abierto' ELSE 'Cerrado' END as estado,p.fecha_inicio,p.fecha_fin,CONCAT(u.nombres,' ',u.apellidos) as lider FROM proyecto p JOIN tipo_proyecto t on p.tipo_proyecto_id=t.id JOIN usuario u on p.lidera=u.id WHERE p.finalizado=0");
		return $registros;
	}

	public function getProyectosFinalizados(){
		$registros=DB::select("SELECT t.nombre as tipo,p.titulo,p.codigo,CASE p.finalizado WHEN 0 THEN 'Abierto' ELSE 'Cerrado' END as estado,p.fecha_inicio,p.fecha_fin,CONCAT(u.nombres,' ',u.apellidos) as lider FROM proyecto p JOIN tipo_proyecto t on p.tipo_proyecto_id=t.id JOIN usuario u on p.lidera=u.id WHERE p.finalizado=1");
		return $registros;
	}

	public function getProyectosDeUsuario(string $numero_documento){
		$registros=DB::select("SELECT t.nombre as tipo,p.titulo,p.codigo,CASE p.finalizado WHEN 0 THEN 'Abierto' ELSE 'Cerrado' END as estado,p.fecha_inicio,p.fecha_fin,(SELECT CONCAT(ul.nombres,' ',ul.apellidos) FROM usuario ul WHERE p.lidera=ul.id) AS lider FROM proyecto p  JOIN tipo_proyecto t on p.tipo_proyecto_id=t.id JOIN usuario_has_proyecto up on up.proyecto_id=p.id JOIN usuario u on u.id=up.usuario_id WHERE u.numero_documento=:numero_documento",['numero_documento'=>$numero_documento]);
		return $registros;
	}

	public function getInformacionGeneralProyecto(string $codigo){
		$registro=DB::select("SELECT p.id,titulo,fecha_inicio,fecha_fin,t.nombre as tipo FROM proyecto p JOIN tipo_proyecto t on p.tipo_proyecto_id=t.id WHERE codigo=:codigo",['codigo'=>$codigo]);
		return $registro;
	}
}