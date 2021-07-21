<?php
namespace App\Dominio\Servicios\Usuarios;
interface IRegistrarseServicio{
    public function registrarse(array $datos);
    public function usuarioEstaRegistrado(string $numero_documento);
}
