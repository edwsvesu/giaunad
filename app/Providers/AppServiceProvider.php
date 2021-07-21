<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Dominio\Servicios\Usuarios\IRegistrarseServicio;
use App\Servicios\Usuarios\RegistrarseServicio;
use App\Dominio\Repositorios\IRepositorioUsuario;
use App\Persistencia\Repositorios\RepositorioUsuario;

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
