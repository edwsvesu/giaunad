@extends('layouts.dashboardLayout')
@section('rol')
Estudiante
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
@endsection