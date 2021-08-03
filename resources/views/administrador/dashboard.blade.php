@extends('layouts.dashboardLayout')

@section('menuLateral')
<li><a><i class="fa fa-user"></i> Integrantes del grupo <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu">
    <li><a href="/usuarios">Integrantes</a></li>
    <li><a href="#">Solicitudes de ingreso</a></li>
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
@endsection


