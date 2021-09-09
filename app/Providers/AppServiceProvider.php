<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Dominio\Servicios\Usuarios\IRegistrarseServicio;
use App\Servicios\Usuarios\RegistrarseServicio;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuario;
use App\Persistencia\Repositorios\RepositorioUsuario;
use App\Dominio\Servicios\Usuarios\IUsuarioServicio;
use App\Servicios\Usuarios\UsuarioServicio;
use App\Dominio\Persistencia\Repositorios\IRepositorioRol;
use App\Persistencia\Repositorios\RepositorioRol;
use App\Dominio\Servicios\Usuarios\IReporteServicio;
use App\Servicios\Usuarios\ReporteServicio;
use App\Dominio\Persistencia\Repositorios\IReportes;
use App\Persistencia\Repositorios\Reportes;
use App\Dominio\Servicios\Proyectos\IReporteServicio as IReporteServicioP;
use App\Servicios\Proyectos\ReporteServicio as ReporteServicioP;
use App\Dominio\Persistencia\Repositorios\IRepositorioTipoProyecto;
use App\Persistencia\Repositorios\RepositorioTipoProyecto;
use App\Dominio\Servicios\Proyectos\IProyectoServicio;
use App\Servicios\Proyectos\ProyectoServicio;
use App\Dominio\Persistencia\Repositorios\IRepositorioProyecto;
use App\Persistencia\Repositorios\RepositorioProyecto;
use App\Dominio\Persistencia\Repositorios\IRepositorioDocumento;
use App\Persistencia\Repositorios\RepositorioDocumento;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuarioHasProyecto;
use App\Persistencia\Repositorios\RepositorioUsuarioHasProyecto;
use App\Dominio\Persistencia\Repositorios\IRepositorioNivel;
use App\Persistencia\Repositorios\RepositorioNivel;
use App\Dominio\Servicios\Usuarios\Curriculum\IDatosGeneralesServicio;
use App\Servicios\Usuarios\Curriculum\DatosGeneralesServicio;
use App\Dominio\Persistencia\Repositorios\IRepositorioInforme;
use App\Persistencia\Repositorios\RepositorioInforme;
use App\Dominio\Servicios\Proyectos\IInformeServicio;
use App\Servicios\Proyectos\InformeServicio;
use App\Dominio\Persistencia\Repositorios\IRepositorioArchivoInforme;
use App\Persistencia\Repositorios\RepositorioArchivoInforme;

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
        $this->app->bind(IReporteServicio::class,ReporteServicio::class);
        $this->app->bind(IReportes::class,Reportes::class);
        $this->app->bind(IReporteServicioP::class,ReporteServicioP::class);
        $this->app->bind(IRepositorioTipoProyecto::class,RepositorioTipoProyecto::class);
        $this->app->bind(IProyectoServicio::class,ProyectoServicio::class);
        $this->app->bind(IRepositorioProyecto::class,RepositorioProyecto::class);
        $this->app->bind(IRepositorioDocumento::class,RepositorioDocumento::class);
        $this->app->bind(IRepositorioUsuarioHasProyecto::class,RepositorioUsuarioHasProyecto::class);
        $this->app->bind(IRepositorioNivel::class,RepositorioNivel::class);
        $this->app->bind(IDatosGeneralesServicio::class,DatosGeneralesServicio::class);
        $this->app->bind(IRepositorioInforme::class,RepositorioInforme::class);
        $this->app->bind(IInformeServicio::class,InformeServicio::class);
        $this->app->bind(IRepositorioArchivoInforme::class,RepositorioArchivoInforme::class);
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
