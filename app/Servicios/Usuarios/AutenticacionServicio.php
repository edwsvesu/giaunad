<?php
namespace App\Servicios\Usuarios;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Dominio\Servicios\Usuarios\IAutenticacionServicio;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuario;

class AutenticacionServicio implements IAutenticacionServicio{
	private IRepositorioUsuario $RepositorioUsuario;

	public function __construct(IRepositorioUsuario $RepositorioUsuario){
		$this->RepositorioUsuario=$RepositorioUsuario;		
	}

	public function autenticar($credenciales){
		if(!Auth::attempt($credenciales)){
			throw ValidationException::withMessages([
	        'email' =>"Estas credenciales no coinciden con nuestros registros.",
	    	]);
		}
	session()->regenerate();
	if(Auth::user()->verificado==0){
		$this->cerrarSesion();
		throw ValidationException::withMessages([
	        'verificado' =>"Esta cuenta aún no está verificada",
	    ]);
	}
	}

	public function cerrarSesion(){
		Auth::guard('web')->logout();
	session()->invalidate();
	session()->regenerateToken();
	}
}