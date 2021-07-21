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
}
