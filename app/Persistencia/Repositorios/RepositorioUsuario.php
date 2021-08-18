<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Repositorios\IRepositorioUsuario;

class RepositorioUsuario implements IRepositorioUsuario{
    public function insertar(array $datos){
        DB::insert("INSERT INTO usuario (nombres,apellidos,numero_documento,correo_principal,correo_secundario,clave) VALUES (:nombres,:apellidos,:numero_documento,:correo_principal,:correo_secundario,:clave)",$datos);
    }

    public function buscarPorDocumento(string $numero_documento){
        $registro=DB::select("SELECT * FROM usuario WHERE numero_documento=:numero_documento",['numero_documento'=>$numero_documento]);
        return $registro;
    }

    public function eliminar(string $numero_documento){
        $borrado=DB::delete("DELETE FROM usuario WHERE numero_documento=:numero_documento",['numero_documento'=>$numero_documento]);
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
}
