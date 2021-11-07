@extends('administrador.dashboard')
@section('estilos')
<!-- Datatables -->
<link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/scroller.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
<script>
$(document).ready(function(){
var table = $('#datatable').DataTable({
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
});
});
</script>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-users"></i> Integrantes del grupo</h2>
                <div class="clearfix"></div>
            </div>
<table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Documento</th>
                          <th>Teléfonos</th>
                          <th>Correo principal</th>
                          <th>Correo secundario</th>
                          <th>Rol</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach($integrantes as $integrante)
                            <tr>
                              <td>{{$integrante->nombres}}</td>
                              <td>{{$integrante->apellidos}}</td>
                              <td>{{$integrante->numero_documento}}</td>
                              <td>{{$integrante->telefonos}}</td>
                              <td>{{$integrante->correo_principal}}</td>
                              <td>{{$integrante->correo_secundario}}</td>
                              <td>{{$integrante->rol}}</td>
                              <td>
                                <button value="{{$integrante->numero_documento}}" data-toggle="modal" data-target="#modal-del-usuario" class="btn btn-danger btn-xs btn-del-usuario"><i class="fa fa-trash-o"></i> eliminar</button>
                                <a  href="/usuario/{{$integrante->id}}/cambiar-contrasena" class="btn btn-dark btn-xs btn-del-usuario"><i class="fa fa-edit"></i> Cambiar contraseña</a>
                              </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    </div>
</div>
</div>

<div id="modal-del-usuario" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Eliminar usuario</h4>
      </div>
      <div class="modal-body">
        <h4>¿Está seguro que desea eliminar el usuario seleccionado?</h4>
        <p>Si continua con esta acción se eliminará permanentemente, pulse <strong>ACEPTAR</strong> para continuar.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
        <button id="btn-elim-usuario" type="button" class="btn btn-danger" data-dismiss="modal">ACEPTAR</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
 <!-- Datatables -->
 <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
 <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
 <script src="{{asset('js/buttons.bootstrap.min.js')}}"></script>
 <script src="{{asset('js/buttons.flash.min.js')}}"></script>
 <script src="{{asset('js/buttons.html5.min.js')}}"></script>
 <script src="{{asset('js/buttons.print.min.js')}}"></script>
 <script src="{{asset('js/dataTables.fixedHeader.min.js')}}"></script>
 <script src="{{asset('js/dataTables.keyTable.min.js')}}"></script>
 <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
 <script src="{{asset('js/responsive.bootstrap.js')}}"></script>
 <script src="{{asset('js/dataTables.scroller.min.js')}}"></script>
 
 <script>
   var elementoSeleccionado;
   $(".btn-del-usuario").click(function() {
     elementoSeleccionado=$(this);
   });
   $("#btn-elim-usuario").click(function(){
     eliminarUsuario(elementoSeleccionado);
   });
    function eliminarUsuario(elemento){
      $.ajax({
          url:window.location.pathname,
          data: {
            numero_documento:$(elemento).val()
          },
          method:'DELETE',
          beforeSend:function(){
              ActivarEfectoCargaPagina();
          },
          complete:function(){
              DesactivarEfectoCargaPagina();
          },
          success: function(data){
              if(data!=0){
                $('#datatable').DataTable().row($(elemento).closest("tr").get(0)).remove().draw();
                mensajeExito("Se ha eliminado correctamente");
              }
              else{
                  mensajeError("No se pudo eliminar el usuario");
              }
          },
          error:function(){
              mensajeError("Ha ocurrido un error, la acción no se ha realizado");
          }
      });
    }
 </script>
@endsection