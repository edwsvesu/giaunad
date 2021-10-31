@section('estilos')
<!-- bootstrap-daterangepicker -->
<link href="{{asset('css/daterangepicker.css')}}" rel="stylesheet">
<!-- Switchery -->
<link href="{{asset('css/switchery.min.css')}}" rel="stylesheet">
<link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
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
                    <h2><i class="fa fa-folder"></i> Crear nuevo proyecto</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="form-proyecto" action="/proyectos/nuevo" enctype="multipart/form-data" method="post" data-parsley-validate class="form-horizontal form-label-left">
                      @csrf
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Código <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input name="codigo" type="text" class="form-control col-md-7 col-xs-12" required="required" maxlength="50">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Título <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="titulo" class="form-control col-md-7 col-xs-12" required="required" maxlength="330">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de proyecto <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="tipo_proyecto_id" name="tipo_proyecto_id" class="form-control" required="required">
                              <option selected value="">Seleccione un tipo</option>
                            @foreach($tipos_proyectos as $tipo)
                              <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-crud-tipo"><i class="fa fa-edit"></i></button>
                      </div>

                      <div class="form-group">
                        <label for="lider" class="control-label col-md-3 col-sm-3 col-xs-12">Lider <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="lidera" class="form-control col-md-7 col-xs-12" list="datalistOptions" type="text" autocomplete="off" required="required">
                          <input id="lidera_id" type="hidden" name="lidera">
                          <datalist id="datalistOptions">
                            @foreach($usuarioslideres as $usuariolider)
                              <option data-value="{{$usuariolider->id}}" value="{{$usuariolider->usuario}}"></option>
                            @endforeach
                          </datalist>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="fecha_inicio" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha inicio <span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3 col-xs-12">      
                          <input name="fecha_inicio" type="date" class="form-control col-md-7 col-xs-12" placeholder="fecha de inicio" required="required">
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="fecha_fin" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha fin</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">      
                          <input name="fecha_fin" type="date" class="form-control col-md-7 col-xs-12" placeholder="Fecha fin">
                        </div>
                      </div>                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Documentacion
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input name="documento[]" type="file" multiple>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button id="btn-cancel" type="reset" class="btn btn-default">Cancelar</button>
                          <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

  <div id="modal-crud-tipo" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Administrar tipos de proyecto</h4>
        </div>
        <div class="modal-body">
          <button id="btn-add-tipo" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form-tipo">Crear</button>
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                  <tr>
                  <th>Tipo</th>
                  <th>Acciones</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($tipos_proyectos as $tipo)
                  <tr>
                  <td>{{$tipo->nombre}}</td>
                  <td>
                    <button class="btn btn-dark btn-xs btn-edit-tipo" value="{{$tipo->id}}" data-value="{{$tipo->nombre}}" data-toggle="modal" data-target="#modal-form-tipo"><i class="fa fa-pencil"></i> Editar</button>

                    <button value="{{$tipo->id}}" data-toggle="modal" data-target="#modal-eliminar-tipo" class="btn btn-danger btn-xs btn-eliminar-tipo"><i class="fa fa-trash-o"></i> Borrar</button>
                  </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
</div>

<div id="modal-form-tipo" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Tipo de proyecto</h4>
        </div>
        <div class="modal-body">
          <label>Tipo</label>
          <input id="tipo_proyecto_id_act" type="hidden">
          <input id="tipo_proyecto" type="text">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button id="btn-action-form" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
        </div>
      </div>
    </div>
</div>

<div id="modal-eliminar-tipo" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Eliminar tipo de proyecto</h4>
        </div>
        <div class="modal-body">
          <h4>¿Está seguro que desea eliminar el tipo de proyecto seleccionado?</h4>
          <p>Si continua con esta acción se eliminará permanentemente, y la información asociada a el se perderá, pulse <strong>ACEPTAR</strong> para continuar.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
          <button id="btn-del-tipo" type="button" class="btn btn-primary" data-dismiss="modal">ACEPTAR</button>
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
      $("#lidera").change(function(){
        $("#lidera_id").val($("#datalistOptions option[value='"+$(this).val()+"']").data('value'));
      });
    </script>

    <!-- bootstrap-datetimepicker -->
    <script src="{{asset('js/moment.min.js')}}"></script> 
    <script src="{{asset('js/daterangepicker.js')}}"></script>
    <!-- jQuery Knob -->
    <script src="{{asset('js/jquery.knob.min.js')}}"></script>
    <!-- Switchery -->
    <script src="{{asset('js/switchery.min.js')}}"></script>
    <script>
      $("#btn-cancel").click(function() {
        $("#form-proyecto").parsley().reset();
      });
        $("#fecha_nula").click(function(e){
          if($("#single_cal4").prop("disabled")==false){
            $("#single_cal4").attr("disabled","true");
          }
          else{
            $("#single_cal4").removeAttr("disabled");
          }
        });

        $("#btn-add-tipo").click(function(){
          $("#btn-action-form").val(1);
          $("#tipo_proyecto").val("");
        });

        var elementoSeleccionado;
        
        $("#btn-action-form").click(function(){
          if($(this).val()==1){
            crearTipoProyecto($("#tipo_proyecto").val());
          }
          else if($(this).val()==2){
            editarTipoProyecto($("#tipo_proyecto_id_act").val(),$("#tipo_proyecto").val(),elementoSeleccionado);
          }
        });

        $(".btn-eliminar-tipo").click(function(){
          elementoSeleccionado=$(this);
          $("#btn-del-tipo").val($(this).val());
        });


        $("#btn-del-tipo").click(function(){
          eliminarTipoProyecto($(this).val(),elementoSeleccionado);
        });


        $(".btn-edit-tipo").click(function(){
          $("#tipo_proyecto").val($(this).data('value'));
          $("#tipo_proyecto_id_act").val($(this).val());
          $("#btn-action-form").val(2);
          elementoSeleccionado=$(this);
        });

        function eliminarTipoProyecto(tipo_proyecto_id,elemento){
          $.ajax({
            url:'/proyectos/tipo-proyecto',
            data: {
              tipo_proyecto_id_el:tipo_proyecto_id,
            },
            method:'DELETE',
            beforeSend:function(){
                ActivarEfectoCargaPagina();
            },
            complete:function(){
                DesactivarEfectoCargaPagina();
            },
            success: function(data){
                if(data==1){
                  $('#datatable').DataTable().row($(elemento).closest("tr").get(0)).remove().draw(false);
                  $("#tipo_proyecto_id option[value='"+tipo_proyecto_id+"']").remove();
                }
                else{
                    mensajeError("No se eliminó el tipo");
                }
            },
            error:function(){
                mensajeError("Ha ocurrido un error, la acción no se ha realizado");
            }
          });
        }

        function editarTipoProyecto(tipo_proyecto_id,nuevo_valor,elemento){
          $.ajax({
            url:'/proyectos/tipo-proyecto',
            data: {
              tipo_proyecto_id_act:tipo_proyecto_id,
              nuevo_valor:nuevo_valor
            },
            method:'PUT',
            beforeSend:function(){
                ActivarEfectoCargaPagina();
            },
            complete:function(){
                DesactivarEfectoCargaPagina();
            },
            success: function(data){
                if(data){
                  $('#datatable').DataTable().row($(elemento).closest("tr").get(0)).remove().draw(false);
                  $('#datatable').DataTable().row.add([
                      nuevo_valor,
                      "<button class='btn btn-info btn-xs btn-edit-tipo' value='"+tipo_proyecto_id+"' data-value='"+nuevo_valor+"' data-toggle='modal' data-target='#modal-form-tipo'><i class='fa fa-pencil'></i> Editar</button><button value='"+tipo_proyecto_id+"' data-toggle='modal' data-target='#modal-eliminar-tipo' class='btn btn-danger btn-xs btn-eliminar-tipo'><i class='fa fa-trash-o'></i> Borrar</button>"
                      
                  ]).draw( false );
                  $("#tipo_proyecto_id option[value='"+tipo_proyecto_id+"']").remove();
                  $("#tipo_proyecto_id").append("<option value='"+tipo_proyecto_id+"'>"+nuevo_valor+"</option>");

                  $(".btn-eliminar-tipo").click(function(){
                    elementoSeleccionado=$(this);
                    $("#btn-del-tipo").val($(this).val());
                  });
                   $(".btn-edit-tipo").click(function(){
                    $("#tipo_proyecto").val($(this).data('value'));
                    $("#tipo_proyecto_id_act").val($(this).val());
                    $("#btn-action-form").val(2);
                    elementoSeleccionado=$(this);
                  });

                }
                else{
                    mensajeError("No se actualizó el tipo");
                }
            },
            error:function(){
                mensajeError("Ha ocurrido un error, la acción no se ha realizado");
            }
          });
        }

        function crearTipoProyecto(tipo_proyecto){
          $.ajax({
            url:'/proyectos/nuevo/tipo-proyecto',
            data: {
              tipo_proyecto:tipo_proyecto
            },
            method:'POST',
            beforeSend:function(){
                ActivarEfectoCargaPagina();
            },
            complete:function(){
                DesactivarEfectoCargaPagina();
            },
            success: function(data){
                if(data){
                  $('#datatable').DataTable().row.add([
                      tipo_proyecto,
                      "<button class='btn btn-info btn-xs btn-edit-tipo' value='"+data+"' data-value='"+tipo_proyecto+"' data-toggle='modal' data-target='#modal-form-tipo'><i class='fa fa-pencil'></i> Editar</button><button value='"+data+"' data-toggle='modal' data-target='#modal-eliminar-tipo' class='btn btn-danger btn-xs btn-eliminar-tipo'><i class='fa fa-trash-o'></i> Borrar</button>"
                      
                  ]).draw( false );
                  $("#tipo_proyecto_id").append("<option value='"+data+"'>"+tipo_proyecto+"</option>");
                   $(".btn-eliminar-tipo").click(function(){
                    elementoSeleccionado=$(this);
                    $("#btn-del-tipo").val($(this).val());
                  });
                   $(".btn-edit-tipo").click(function(){
                    $("#tipo_proyecto").val($(this).data('value'));
                    $("#tipo_proyecto_id_act").val($(this).val());
                    $("#btn-action-form").val(2);
                    elementoSeleccionado=$(this);
                  });
                }
                else{
                    mensajeError("No se creó el nuevo tipo");
                }
            },
            error:function(){
                mensajeError("Ha ocurrido un error, la acción no se ha realizado");
            }
          });
        }
    </script>
@endsection