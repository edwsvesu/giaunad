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

	public function getUsuariosAptosComoLideresSemillero(){
        $registros=DB::select("SELECT u.id,CONCAT(u.nombres,' ',u.apellidos,' | CC. ',u.numero_documento) as usuario 
		FROM usuario u
		WHERE rol_id=4 AND verificado=1");
        return $registros;
    }

	public function getUsuariosAptosComoCoordinadoresSemillero(){
        $registros=DB::select("SELECT u.id,CONCAT(u.nombres,' ',u.apellidos,' | CC. ',u.numero_documento) as usuario 
		FROM usuario u
		WHERE rol_id=3 AND verificado=1");
        return $registros;
    }

	public function getInformacionGeneralSemillero(string $codigo)
	{
		$consulta=DB::select("SELECT s.id,s.codigo,s.nombre,s.fecha_inicio FROM semillero s WHERE s.codigo=:codigo",['codigo'=>$codigo]);
		return $consulta;
	}

	public function getInformacionEncargadosDeSemillero(int $id)
	{
		$consulta=DB::select("SELECT u.foto,u.nombres,u.apellidos,'Coordinador' as funcion
		FROM usuario u
		JOIN semillero s ON u.id=s.coordinador_id
		WHERE s.id=:id
		UNION
		SELECT u.foto,u.nombres,u.apellidos,'Lider'
		FROM usuario u
		JOIN semillero s ON u.id=s.lider_id
		WHERE s.id=:id2",['id'=>$id,'id2'=>$id]);
		return $consulta;
	}

	public function getUsuariosAptosComoSemilleristas(int $semillero_id)
	{
		$consulta=DB::select("SELECT u.id,u.foto,u.nombres,u.apellidos,CONCAT(u.nombres,' ',u.apellidos,' | CC. ',u.numero_documento) as usuario
		FROM usuario u
		WHERE u.verificado=1 AND u.rol_id=4 AND u.id NOT IN (SELECT usuario_id FROM usuario_has_semillero WHERE semillero_id=:semillero_id) AND u.id NOT IN (SELECT lider_id FROM semillero s WHERE s.id=:semillero_id2)",['semillero_id'=>$semillero_id,'semillero_id2'=>$semillero_id]);
		return $consulta;
	}

	public function getInformacionDeSemilleristas(int $semillero_id){
		$registros=DB::select("SELECT u.id,u.numero_documento,u.foto,u.nombres,u.apellidos,'semillerista' as funcion
		FROM usuario u
		JOIN usuario_has_semillero us ON u.id=us.usuario_id
		WHERE us.semillero_id=:semillero_id",['semillero_id'=>$semillero_id]);
		return $registros;
	}

	public function getInformacionDeActividadDeSemillero(int $semillero_id,string $codigo_actividad)
	{
		$consulta=DB::select('SELECT * FROM actividad WHERE semillero_id=:semillero_id AND codigo=:codigo', ['semillero_id'=>$semillero_id,'codigo'=>$codigo_actividad]);
		return $consulta;
	}

	public function getSemillerosVigentes()
	{
		$registros=DB::select('SELECT * FROM semillero');
		return $registros;
	}

	public function getSemillerosDeUsuario(int $usuario_id)
	{
		$registros=DB::select('SELECT nombre,codigo
		FROM semillero
		WHERE id IN (SELECT semillero_id
					FROM usuario_has_semillero
					WHERE usuario_id=:usuario_id) OR lider_id=:lider_id OR coordinador_id=:coordinador_id',['usuario_id'=>$usuario_id,'lider_id'=>$usuario_id,'coordinador_id'=>$usuario_id]);
		return $registros;
	}

	public function getInformacionDeEntrega(int $actividad_id,int $usuario_id)
	{
		$registro=DB::select('SELECT *
		FROM entrega
		WHERE actividad_id=:actividad_id AND usuario_id=:usuario_id',['actividad_id'=>$actividad_id,'usuario_id'=>$usuario_id]);
		return $registro;
	}

	public function getEntregasPorActividad(int $semillero_id)
	{
		$registros=DB::select('SELECT CONCAT(u.nombres," ",u.apellidos) as usuario,u.numero_documento as codigo
		FROM usuario u
		JOIN usuario_has_semillero us ON u.id=us.usuario_id
		WHERE us.semillero_id=:semillero_id',['semillero_id'=>$semillero_id]);
		return $registros;
	}
}