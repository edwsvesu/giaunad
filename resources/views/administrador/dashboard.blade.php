@extends('layouts.dashboardLayout')
@section('rol')
Lider del grupo
@endsection
@section('menuLateral')

<li><a><i class="fa fa-archive"></i> Currículum <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu">
      <li><a>Datos generales <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="/curriculum/datos-generales/datos-personales">Datos personales</a></li>
          <li><a href="/curriculum/datos-generales/formacion-academica">Formación académica</a></li>
          <li><a href="/curriculum/datos-generales/formacion-idiomas">Formación de idiomas</a></li>
          <li style="display: none;"><a href="/curriculum/datos-generales/datos-personales/editar"></a></li>
        </ul>
      </li>
    </ul>
</li>

<li><a><i class="fa fa-user"></i> Integrantes del grupo <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu">
    <li><a href="/usuarios">Usuarios</a></li>
    <li><a href="/usuarios/solicitudes">Solicitudes de ingreso</a></li>
    </ul>
</li>

<li><a><i class="fa fa-folder"></i> Proyectos <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu">
    <li><a href="/proyectos/nuevo">Nuevo proyecto</a></li>
    <li><a href="/proyectos/vigentes">Proyectos vigentes</a></li>
    <li><a href="/proyectos/finalizados">Proyectos finalizados</a></li>
    <li><a href="/proyectos/misproyectos">Mis proyectos</a></li>
    </ul>
</li>
<li><a><i class="fa fa-puzzle-piece"></i> Semilleros <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu">
    <li><a href="/semilleros/vigentes">semilleros</a></li>
    <li><a href="/semilleros/nuevo">Nuevo semillero</a></li>
    </ul>
</li>
@endsection


