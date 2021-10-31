<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuario;

class RepositorioUsuario implements IRepositorioUsuario{
    public function insertar(array $datos){
        return DB::insert("INSERT INTO usuario (nombres,apellidos,numero_documento,correo_principal,correo_secundario,password) VALUES (:nombres,:apellidos,:numero_documento,:correo_principal,:correo_secundario,:clave)",$datos);
    }

    public function buscarPorDocumento(string $numero_documento){
        $registro=DB::select("SELECT * FROM usuario WHERE numero_documento=:numero_documento",['numero_documento'=>$numero_documento]);
        return $registro;
    }

    public function eliminarPorNoVerificado(string $numero_documento){
        $borrado=DB::delete("DELETE FROM usuario WHERE numero_documento=:numero_documento AND verificado=0",['numero_documento'=>$numero_documento]);
        return $borrado;
    }

    public function getUsuariosNoVerificados(){
        $registros=DB::select('SELECT u.nombres,u.apellidos,u.numero_documento,u.correo_principal,u.correo_secundario,r.nombre as rol FROM usuario u JOIN rol r on u.rol_id=r.id WHERE u.verificado=0');
        return $registros;
    }

    public function actualizarVerificado(string $numero_documento,int $valor){
        $actualizado=DB::update('UPDATE usuario SET verificado=:valor WHERE numero_documento=:numero_documento',['valor'=>$valor,'numero_documento'=>$numero_documento]);
        return $actualizado;
    }

    public function actualizarRol(string $numero_documento,int $rol_id){
        $actualizado=DB::update('UPDATE usuario SET rol_id=:rol_id WHERE numero_documento=:numero_documento',['rol_id'=>$rol_id,'numero_documento'=>$numero_documento]);
        return $actualizado;
    }

    public function getUsuariosAptosComoLideres(){
        $registros=DB::select("SELECT id,CONCAT(nombres,' ',apellidos,' | CC. ',numero_documento) as usuario FROM usuario WHERE rol_id!=4 AND verificado!=0");
        return $registros;
    }

    public function getUsuariosAptosComoIntegrantesProyecto(int $proyecto_id){
        $registros=DB::select("SELECT DISTINCT u.id,CONCAT(u.nombres,' ',u.apellidos,' | CC. ',u.numero_documento) as usuario FROM usuario u WHERE verificado!=0 AND u.rol_id!=4 AND id NOT IN (SELECT usuario_id FROM usuario_has_proyecto WHERE proyecto_id=:proyecto_id)",['proyecto_id'=>$proyecto_id]);
        return $registros;
    }

    public function editar(array $datos){
        $sql="UPDATE usuario set nombres=:nombres,apellidos=:apellidos,correo_principal=:correo_principal,correo_secundario=:correo_secundario,foto=:foto WHERE id=:id";
        $actualizado=DB::update($sql,$datos);
        return $actualizado;
    }

    public function getFoto(int $id){
        return DB::select("SELECT foto from usuario WHERE id=:id",['id'=>$id]);
    }
}
