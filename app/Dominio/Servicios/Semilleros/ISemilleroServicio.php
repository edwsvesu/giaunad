<?php
namespace App\Dominio\Servicios\Semilleros;
interface ISemilleroServicio{
    public function crear(array $datos,int $usuario_rol);
    public function getUsuariosAptosComoLideresSemillero();
    public function getUsuariosAptosComoCoordinadoresSemillero();
    public function getInformacionSemillero(string $codigo);
    public function getInformacionEntrega(int $actividad_id,int $usuario_id);
    public function getInformacionActividad(int $semillero_id,string $codigo_actividad);
    public function getArchivosDeEntrega(int $entrega_id);
    public function crearEntregaSiNoExiste($semillero_codigo,$codigo_actividad,$usuario_id);
    public function subirArchivoEntrega(array $datos,$codigo_semillero,$codigo_actividad,$usuario_id);
    public function eliminarArchivoEntrega(string $codigo_semillero,string $codigo_actividad,int $usuario_id,string $ruta);
    public function getEntregasPorActividad(int $semillero_id);
    public function usuarioEsLiderDeSemillero(int $semillero_id,int $usuario_id);
    public function usuarioEsSemilleristaDeSemillero(int $semillero_id,int $usuario_id);
    public function usuarioEsSemilleristaDeSemilleroPorCodigo(int $semillero_id,string $usuario_cod);
}