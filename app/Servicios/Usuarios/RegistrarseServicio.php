<?php
namespace App\Servicios\Usuarios;
use App\Dominio\Servicios\Usuarios\IRegistrarseServicio;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuario;
use App\Dominio\Modelos\Usuario;
use Illuminate\Support\Facades\Mail;
use App\Dominio\Email\UsuarioRegistrado;

//para enviar correo despues del registro comun
//Mail::to('ivinernesto123@gmail.com')->send(new UsuarioRegistrado($arreglo));

class RegistrarseServicio implements IRegistrarseServicio{
    private IRepositorioUsuario $RepositorioUsuario;

    public function __construct(IRepositorioUsuario $RepositorioUsuario)
    {
        $this->RepositorioUsuario=$RepositorioUsuario;
    }

    public function registrarse(array $datos){
        if(!$this->usuarioEstaRegistrado(isset($datos['numero_documento']) ? $datos['numero_documento']:'')){
            $usuario=new Usuario();
            $usuario->setNombres(isset($datos['nombres']) ? $datos['nombres']:'');
            $usuario->setApellidos(isset($datos['apellidos']) ? $datos['apellidos']:'');
            $usuario->setNumero_documento(isset($datos['numero_documento']) ? $datos['numero_documento']:'');
            $usuario->setCorreo_principal(isset($datos['correo_principal']) ? $datos['correo_principal']:'');
            $usuario->setCorreo_secundario(isset($datos['correo_secundario']) ? $datos['correo_secundario']:'');
            $usuario->setClave(isset($datos['clave']) ? $datos['clave']:'');
            if(!($usuario->validez()->fails())){
                $arreglo=array(
                    'nombres'=>$usuario->getNombres(),
                    'apellidos'=>$usuario->getApellidos(),
                    'numero_documento'=>$usuario->getNumero_documento(),
                    'correo_principal'=>$usuario->getCorreo_principal(),
                    'correo_secundario'=>$usuario->getCorreo_secundario(),
                    'clave'=>$usuario->getClaveEncriptada()
                );
                $this->RepositorioUsuario->insertar($arreglo);
                $salida=array('accion'=>'true','mensaje'=>'Debes esperar hasta que el administrador te permita ingresar al sistema');
                return $salida;
            }
            else{
                $salida=array('accion'=>'false','mensaje'=>'Información no válida');
                return $salida;
            }
        }
        else{
            $salida=array('accion'=>'false','mensaje'=>'Ya existe un registro con este numero de documento');
            return $salida;
        }
    }

    public function usuarioEstaRegistrado(string $numero_documento){
        $usuario=$this->RepositorioUsuario->buscarPorDocumento($numero_documento);
        if($usuario){
            return true;
        }
        else{
            return false;
        }
    }
}
