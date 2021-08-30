@extends('administrador.dashboard')
@section('estilos')
<!-- Datatables -->
<link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/buttons.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/responsive.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/scroller.bootstrap.min.css')}}" rel="stylesheet">

<!--PNotify--> 
<link href="{{asset('css/pnotify.css')}}" rel="stylesheet">
<link href="{{asset('css/pnotify.buttons.css')}}" rel="stylesheet">
<link href="{{asset('css/pnotify.nonblock.css')}}" rel="stylesheet">
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
                <h2>Solicitudes de ingreso al grupo</h2>
                <div class="clearfix"></div>
            </div>
<table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Documento</th>
                          <th>correo principal</th>
                          <th>correo secundario</th>
                          <th>Rol</th>
                          <th>Accion</th>
                        </tr>
                      </thead>


                      <tbody>
                        @foreach($solicitudes as $solicitud)
                        <tr>
                          <td>{{$solicitud->nombres}}</td>
                          <td>{{$solicitud->apellidos}}</td>
                          <td>{{$solicitud->numero_documento}}</td>
                          <td>{{$solicitud->correo_principal}}</td>
                          <td>{{$solicitud->correo_secundario}}</td>
                          <td>
                              <select data-value="{{$solicitud->numero_documento}}" class="selectRol">
                                @foreach($roles as $rol)
                                  <option value="{{$rol->id}}" {{($rol->nombre==$solicitud->rol) ? 'selected':''}}>{{$rol->nombre}}</option>
                                @endforeach
                              </select>
                          </td>
                          <td>
                            <button value="{{$solicitud->numero_documento}}" class="btn btn-success btn-xs bntAceptarRegistro"><i class="fa fa-thumbs-o-up"></i> Aceptar </button>
                            <button value="{{$solicitud->numero_documento}}" class="btn btn-danger btn-xs bntEliminarRegistro" data-toggle="modal" data-target="#modal-borrar-usuario"><i class="fa fa-trash-o"></i> Rechazar </button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    </div>
</div>
</div>
<div id="modal-borrar-usuario" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Borrar registro</h4>
        </div>
        <div class="modal-body">
          <h4>¿Desea borrar el registro permanentemente?</h4>
          <p>Si continua con esta acción se eliminara toda la información asociada con este registro, de clic en  <strong>ACEPTAR</strong> para continuar.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
          <button id="bntEliminarRegistro" type="button" class="btn btn-primary" data-dismiss="modal">ACEPTAR</button>
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

 <!-- PNotify -->
<script src="{{asset('js/pnotify.js')}}"></script>
<script src="{{asset('js/pnotify.buttons.js')}}"></script>
<script src="{{asset('js/pnotify.nonblock.js')}}"></script>
<script>
    var elementoSeleccionado; 

    $( "#bntEliminarRegistro" ).click(function(){
        rechazarSolicitud(elementoSeleccionado.val(),elementoSeleccionado);
    });

    $( ".bntEliminarRegistro" ).click(function(){
        elementoSeleccionado=$(this);
    });

    $( ".bntAceptarRegistro" ).click(function(){
        aceptarSolicitud($(this).val(),$(this));
    });

    $(".selectRol").change(function(){
        cambiarRol($(this).data("value"),$(this).val(),$(this));
    });

    function rechazarSolicitud(numero_documento,elemento){
        $.ajax({
            url:'/usuarios/solicitudes/rechazar',
            data:{
                numero_documento:numero_documento
            },
            beforeSend:function(){
                ActivarEfectoCargaPagina();
            },
            complete:function(){
                DesactivarEfectoCargaPagina();
            },
            method:'POST',
            success: function(data){
                if(data=='1'){
                    $('#datatable').DataTable().row($(elemento).closest("tr").get(0)).remove().draw();
                }
                else{
                    mensajeError();
                }
            },
            error:function(){
                mensajeError();
            }
        });
    }

    function aceptarSolicitud(numero_documento,elemento){
        $.ajax({
            url:'/usuarios/solicitudes/aceptar',
            data:{
                numero_documento:numero_documento
            },
            beforeSend:function(){
                ActivarEfectoCargaPagina();
            },
            complete:function(){
                DesactivarEfectoCargaPagina();
            },
            method:'POST',
            success: function(data){
                if(data=='1'){
                    $('#datatable').DataTable().row($(elemento).closest("tr").get(0)).remove().draw();
                }
                else{
                    mensajeError();
                }
            },
            error:function(){
                mensajeError();
            }
        });
    }

    function cambiarRol(numero_documento,rol_id,elemento){
        $.ajax({
            url:'/usuarios/solicitudes/cambiar-rol',
            data:{
                numero_documento:numero_documento,
                rol_id: rol_id
            },
            beforeSend:function(){
                ActivarEfectoCargaPagina();
            },
            complete:function(){
                DesactivarEfectoCargaPagina();
            },
            method:'POST',
            success: function(data){
                if(data=='1'){
                    // ...
                }
                else{
                    mensajeError();
                }
            },
            error:function(){
                mensajeError();
            }
        });
    }


    function mensajeError(){
        new PNotify({
          title: 'Error',
          text: 'Ha ocurrido un error, la acción no se ha realizado',
          type: 'error',
          styling: 'bootstrap3',
          delay: 2000,
          nonblock:{
                nonblock:true
            }
        });
    }
</script>
@endsection