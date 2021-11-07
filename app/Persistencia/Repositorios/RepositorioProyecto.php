<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Persistencia\Repositorios\IRepositorioProyecto;

class RepositorioProyecto implements IRepositorioProyecto{
    public function insertar(array $datos){
        return DB::transaction(function () use ($datos){
            DB::insert('INSERT INTO proyecto(titulo,fecha_inicio,fecha_fin,codigo,tipo_proyecto_id,lidera) VALUES (:titulo,:fecha_inicio,:fecha_fin,:codigo,:tipo_proyecto_id,:lidera)',['titulo'=>$datos['titulo'],'fecha_inicio'=>$datos['fecha_inicio'],'fecha_fin'=>$datos['fecha_fin'],'codigo'=>$datos['codigo'],'tipo_proyecto_id'=>$datos['tipo_proyecto_id'],'lidera'=>$datos['lidera']]);
            $proyecto_id=DB::select("select id from proyecto where codigo=:codigo",['codigo'=>$datos['codigo']]);
            DB::insert('INSERT INTO usuario_has_proyecto(usuario_id,proyecto_id) VALUES (:usuario_id,:proyecto_id)',['usuario_id'=>$datos['lidera'],'proyecto_id'=>$proyecto_id[0]->id]);
            if(!empty($datos['documentos'])){
                foreach ($datos['documentos'] as $documento) {
                    $documento['proyecto_id']=$proyecto_id[0]->id;
                    DB::insert('INSERT INTO documento(nombre,ruta,proyecto_id) VALUES(:nombre,:ruta,:proyecto_id)',$documento);
                }
            }
        });
    }

    public function editar(array $datos)
    {
        $actualizado=DB::update('UPDATE proyecto SET codigo=:codigo,titulo=:titulo,fecha_inicio=:fecha_inicio,fecha_fin=:fecha_fin,tipo_proyecto_id=:tipo_proyecto_id WHERE id=:id',$datos);
        return $actualizado;
    }

    public function buscarPorCodigo(string $codigo){
        $registro=DB::select("SELECT * FROM proyecto WHERE codigo=:codigo",['codigo'=>$codigo]);
        return $registro;
    }

    public function buscarPorId(int $id){
        $registro=DB::select("SELECT * FROM proyecto WHERE id=:id",['id'=>$id]);
        return $registro;
    }

    public function buscarPorIdYLiderId(int $id,int $lidera){
        $registro=DB::select("SELECT * FROM proyecto WHERE id=:id AND lidera=:lidera",['id'=>$id,'lidera'=>$lidera]);
        return $registro;
    }

    public function buscarPorCodigoYLiderId(string $codigo,int $lidera){
        $registro=DB::select("SELECT * FROM proyecto WHERE codigo=:codigo AND lidera=:lidera",['codigo'=>$codigo,'lidera'=>$lidera]);
        return $registro;
    }

    public function getId(string $codigo){
        $registro=DB::select("SELECT id FROM proyecto WHERE codigo=:codigo",['codigo'=>$codigo]);
        return $registro;
    }

    public function eliminar(int $id)
    {
        return DB::delete('DELETE FROM proyecto WHERE id=:id', ['id'=>$id]);
    }

    public function actualizarFinalizado($id,$num)
    {
        return DB::update('UPDATE proyecto SET finalizado=:num WHERE id=:id', ['num'=>$num,'id'=>$id]);
    }
}
