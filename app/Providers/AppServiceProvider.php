<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Dominio\Servicios\Usuarios\IRegistrarseServicio;
use App\Servicios\Usuarios\RegistrarseServicio;
use App\Dominio\Repositorios\IRepositorioUsuario;
use App\Persistencia\Repositorios\RepositorioUsuario;
use App\Dominio\Servicios\Usuarios\IUsuarioServicio;
use App\Servicios\Usuarios\UsuarioServicio;
use App\Dominio\Repositorios\IRepositorioRol;
use App\Persistencia\Repositorios\RepositorioRol;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IRegistrarseServicio::class, RegistrarseServicio::class);
        $this->app->bind(IRepositorioUsuario::class, RepositorioUsuario::class);
        $this->app->bind(IUsuarioServicio::class, UsuarioServicio::class);
        $this->app->bind(IRepositorioRol::class, RepositorioRol::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
