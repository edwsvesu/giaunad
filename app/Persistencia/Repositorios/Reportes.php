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

	public function getProyectosDeUsuario(int $usuario_id){
		$registros=DB::select("SELECT t.nombre as tipo,p.titulo,p.codigo,CASE p.finalizado WHEN 0 THEN 'Abierto' ELSE 'Cerrado' END as estado,p.fecha_inicio,p.fecha_fin,(SELECT CONCAT(ul.nombres,' ',ul.apellidos) FROM usuario ul WHERE p.lidera=ul.id) AS lider FROM proyecto p  JOIN tipo_proyecto t on p.tipo_proyecto_id=t.id JOIN usuario_has_proyecto up on up.proyecto_id=p.id JOIN usuario u on u.id=up.usuario_id WHERE u.id=:usuario_id",['usuario_id'=>$usuario_id]);
		return $registros;
	}

	public function getInformacionGeneralProyecto(string $codigo){
		$registro=DB::select("SELECT p.id,p.codigo,titulo,fecha_inicio,fecha_fin,t.nombre as tipo FROM proyecto p JOIN tipo_proyecto t on p.tipo_proyecto_id=t.id WHERE codigo=:codigo",['codigo'=>$codigo]);
		return $registro;
	}

	public function getIntegrantesDeProyecto(int $proyecto_id){
		$registros=DB::select("SELECT CONCAT(u.nombres,' ',u.apellidos) as nombre,r.nombre as perfil,u.foto, CASE WHEN u.id=p.lidera THEN 'Lider del proyecto' ELSE 'Integrante' END as funcion FROM usuario u JOIN rol r ON r.id=u.rol_id JOIN usuario_has_proyecto up ON u.id=up.usuario_id JOIN proyecto p ON up.proyecto_id=p.id WHERE up.proyecto_id=:proyecto_id",['proyecto_id'=>$proyecto_id]);
		return $registros;
	}

	public function getIntegranteDeProyecto(string $proyecto_cod,int $usuario_id){
		$registros=DB::select("SELECT CONCAT(u.nombres,' ',u.apellidos) as nombre,r.nombre as perfil,u.foto, CASE WHEN u.id=p.lidera THEN 'Lider del proyecto' ELSE 'Integrante' END as funcion FROM usuario u JOIN rol r ON r.id=u.rol_id JOIN usuario_has_proyecto up ON u.id=up.usuario_id JOIN proyecto p ON up.proyecto_id=p.id WHERE p.codigo=:proyecto_cod AND u.id=:usuario_id",['proyecto_cod'=>$proyecto_cod,'usuario_id'=>$usuario_id]);
		return $registros;
	}

	public function getInforme(int $informe_id,string $cod_proyecto){
		$registro=DB::select("SELECT i.*,p.codigo as proyecto_cod FROM informe i JOIN proyecto p ON i.proyecto_id=p.id WHERE i.id=:informe_id AND p.codigo=:cod_proyecto",['informe_id'=>$informe_id,'cod_proyecto'=>$cod_proyecto]);
		return $registro;
	}

	public function getDatosPersonalesUsuario(int $usuario_id){
		$registro=DB::select("SELECT u.id,u.numero_documento,u.nombres,u.apellidos,u.correo_principal,u.correo_secundario,u.foto FROM usuario u WHERE u.id=:usuario_id",['usuario_id'=>$usuario_id]);
		return $registro;
	}

	public function getTodaFormacionAcademicaPorUsuario(int $usuario_id){
		$registros=DB::select("SELECT f.id,n.nombre as nivel,f.titulo,i.nombre as institucion FROM formacion_academica f JOIN nivel n ON f.nivel_id=n.id JOIN institucion i ON f.institucion_id=i.id WHERE usuario_id=:usuario_id",['usuario_id'=>$usuario_id]);
		return $registros;
	}

	public function getFormacionAcademicaPorUsuario(int $formacion_id,int $usuario_id){
		$registro=DB::select("SELECT f.*,n.id as nivel_id,n.nombre as nivel,i.id as institucion_id,i.nombre as institucion FROM formacion_academica f JOIN nivel n ON f.nivel_id=n.id JOIN institucion i ON f.institucion_id=i.id WHERE f.usuario_id=:usuario_id AND f.id=:formacion_id",['formacion_id'=>$formacion_id,'usuario_id'=>$usuario_id]);
		return $registro;
	}
}