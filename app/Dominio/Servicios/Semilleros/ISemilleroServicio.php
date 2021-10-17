<?php
namespace App\Dominio\Servicios\Semilleros;
interface ISemilleroServicio{
    public function crear(array $datos,int $usuario_rol);
    public function getUsuariosAptosComoLideresSemillero();
    public function getUsuariosAptosComoCoordinadoresSemillero();
    public function getInformacionSemillero(string $codigo);
}