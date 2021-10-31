@section('estilos')
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
                <h2><i class="fa fa-flag"></i> Formación de idiomas</h2>
                <div class="clearfix"></div>
            </div>
            <button id="btn-add-idioma" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar-idioma">Nuevo</button>
            <br>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
        <th>Idioma</th>
        <th>Nivel de lectura</th>
        <th>Nivel de escritura</th>
        <th>Nivel de habla</th>
        <th>Nivel de escucha</th>
        <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($formacion as $idioma)
            <tr>
            <td>{{$idioma->idioma}}</td>
            <td>{{$idioma->lectura}}</td>
            <td>{{$idioma->escritura}}</td>
            <td>{{$idioma->habla}}</td>
            <td>{{$idioma->escucha}}</td>
            <td><button class="btn btn-dark btn-xs btn-edit-idioma" data-toggle="modal" data-target="#modal-agregar-idioma" data-idioma="{{$idioma->idioma_id}}" data-lectura="{{$idioma->lectura}}" data-escritura="{{$idioma->escritura}}" data-habla="{{$idioma->habla}}" data-escucha="{{$idioma->escucha}}" value="{{$idioma->id}}"><i class="fa fa-pencil"></i> Editar</button>
            <button value="{{$idioma->id}}" data-toggle="modal" data-target="#modal-eliminar-idioma" class="btn btn-danger btn-xs btn-eliminar-fidioma"><i class="fa fa-trash-o"></i> Borrar</button>
            </td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>
</div>
</div>

<div id="modal-agregar-idioma" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" >Formación de idiomas</h4>
        </div>
        <div class="modal-body">
          <!-- formulario-->
          <form id="form-idioma" action="" method="post" data-parsley-validate class="form-horizontal form-label-left">
            @csrf
            <input id='input-put-form' type='hidden'>
            <input id="formacion_id" type="hidden" name="formacion_id">
            <div id="input-idio-form" class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Idioma</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select id="select-opt-idioma" name="idioma_id" class="form-control" required="required" data-parsley-required-message="Campo obligatorio">
                      <option  value="">Seleccione un idioma</option>
                      @foreach($idiomas as $idioma)
                       <option value="{{$idioma->id}}">{{$idioma->nombre}}</option>
                      @endforeach
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Nivel de lectura</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select id="select-lec" name="lectura" class="form-control" required="required" data-parsley-required-message="Campo obligatorio">
                      <option value="">Seleccione un nivel</option>
                      <option value="Bueno">Bueno</option>
                      <option value="Aceptable">Aceptable</option>
                      <option value="Deficiente">Deficiente</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Nivel de escritura</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select id="select-esc" name="escritura" class="form-control" required="required" data-parsley-required-message="Campo obligatorio">
                      <option value="">Seleccione un nivel</option>
                      <option value="Bueno">Bueno</option>
                      <option value="Aceptable">Aceptable</option>
                      <option value="Deficiente">Deficiente</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Nivel de habla</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select id="select-hab" name="habla" class="form-control" required="required" data-parsley-required-message="Campo obligatorio">
                      <option value="">Seleccione un nivel</option>
                      <option value="Bueno">Bueno</option>
                      <option value="Aceptable">Aceptable</option>
                      <option value="Deficiente">Deficiente</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Nivel de escucha</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select id="select-escu" name="escucha" class="form-control" required="required" data-parsley-required-message="Campo obligatorio">
                      <option value="">Seleccione un nivel</option>
                      <option value="Bueno">Bueno</option>
                      <option value="Aceptable">Aceptable</option>
                      <option value="Deficiente">Deficiente</option>
                  </select>
                </div>
            </div>
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button id="btn-cancel" type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
        </div>
      </div>
          </form>
          <!-- formulario-->
        </div>
      </div>
    </div>
</div>

<div id="modal-eliminar-idioma" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Eliminar formación de idioma</h4>
        </div>
        <div class="modal-body">
          <h4>¿Está seguro que desea eliminar el idioma seleccionado?</h4>
          <p>Si continua con esta acción se eliminará permanentemente, pulse <strong>ACEPTAR</strong> para continuar.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
          <button id="btn-del-idioma" type="button" class="btn btn-danger" data-dismiss="modal">ACEPTAR</button>
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
  $("#btn-cancel").click(function(){
    $("#form-idioma").parsley().reset();
  });

  $(".btn-edit-idioma").click(function(){
      $("#input-put-form").replaceWith("<input id='input-put-form' type='hidden' name='_method' value='PUT'>");
      $("#formacion_id").val($(this).val());
      $("#select-opt-idioma").val($(this).data("idioma"));
      $("#select-opt-idioma").attr("disabled",true);
      $("#select-lec").val($(this).data("lectura"));
      $("#select-hab").val($(this).data("habla"));
      $("#select-esc").val($(this).data("escritura"));
      $("#select-escu").val($(this).data("escucha"));
  });
     $("#btn-add-idioma").click(function(){
        $("#input-put-form").replaceWith("<input id='input-put-form' type='hidden'>");
        $("#select-opt-idioma").val("");
        $("#formacion_id").val("");
        $("#select-opt-idioma").removeAttr("disabled");
        $("#select-lec").val("");
        $("#select-hab").val("");
        $("#select-esc").val("");
        $("#select-escu").val("");
     });

     var elementoSeleccionado;
     $(".btn-eliminar-fidioma").click(function(){
        elementoSeleccionado=$(this);
     });

     $("#btn-del-idioma").click(function(){
        borrarIdioma(elementoSeleccionado.val(),elementoSeleccionado);
     });

    function borrarIdioma(formacion_id_del,elemento){
            $.ajax({
            url:'/curriculum/datos-generales/formacion-idiomas',
            data: {
              formacion_id_del:formacion_id_del
            },
            method:'DELETE',
            beforeSend:function(){
                ActivarEfectoCargaPagina();
            },
            complete:function(){
                DesactivarEfectoCargaPagina();
            },
            success: function(data){
                if(data){
                  $('#datatable').DataTable().row($(elemento).closest("tr").get(0)).remove().draw();
                  mensajeExito("Se ha eliminado correctamente");
                }
                else{
                    mensajeError("No se pudo eliminar");
                }
            },
            error:function(){
                mensajeError("Ha ocurrido un error, la acción no se ha realizado");
            }
        });
    }
 </script>
@endsection