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
                <h2>Formación académica</h2>
                <div class="clearfix"></div>
            </div>
            <button id="btn-add-formacion" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar-formacion">Nuevo</button>
            <br>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
        <th>Nivel</th>
        <th>Titulo</th>
        <th>Institucion</th>
        <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($titulos as $titulo)
            <tr>
            <td>{{$titulo->nivel}}</td>
            <td>{{$titulo->titulo}}</td>
            <td>{{$titulo->institucion}}</td>
            <td>
                <button value="{{$titulo->id}}" data-toggle="modal" data-target="#modal-view-academica" class="btn btn-primary btn-xs view-info-form"><i class="fa fa-eye"></i> Ver</button>
                <button value="{{$titulo->id}}" data-toggle="modal" data-target="#modal-agregar-formacion" class="btn btn-info btn-xs update-info-form"><i class="fa fa-pencil"></i> Editar</button>
                <button value="{{$titulo->id}}" data-toggle="modal" data-target="#modal-del-formacion" class="btn btn-danger btn-xs btn-del-form"><i class="fa fa-trash-o"></i> Borrar</button>
            </td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>
</div>
</div>

<div id="modal-view-academica" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Formación académica</h4>
        </div>
        <div class="modal-body">  
            <p>lored freig ri gjerigj erg jreogr j</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
</div>

<div id="modal-del-formacion" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Eliminar formación académica</h4>
        </div>
        <div class="modal-body">
          <h4>¿Está seguro que desea eliminar la formación académica seleccionada?</h4>
          <p>Si continua con esta acción se eliminará permanentemente, pulse <strong>ACEPTAR</strong> para continuar.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
          <button id="btn-elim-form" type="button" class="btn btn-primary" data-dismiss="modal">ACEPTAR</button>
        </div>
      </div>
    </div>
</div>

<div id="modal-agregar-formacion" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" >Formación académica</h4>
        </div>
        <div class="modal-body">
          <!-- formulario-->
          <form action="" method="post" data-parsley-validate class="form-horizontal form-label-left">
            @csrf
            <input id='input-put-form' type='hidden'>
            <input id="formacion_id" type="hidden" name="formacion_id">
            <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nivel de formación</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="nivel_id" name="nivel_id" class="form-control">
                              <option value="">Nivel de formación</option>
                              @foreach($niveles as $nivel)
                                <option value="{{$nivel->id}}">{{$nivel->nombre}}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Título obtenido <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="titulo" name="titulo" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="lider" class="control-label col-md-3 col-sm-3 col-xs-12">Institución</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="hidden" id="institucion_id" name="institucion_id">
                          <input id="lista-institucion" class="form-control col-md-7 col-xs-12" list="datalistOptions" type="text" autocomplete="off">
                          <datalist id="datalistOptions">
                            @foreach($instituciones as $institucion)
                              <option data-value="{{$institucion->id}}" value="{{$institucion->nombre}}"></option>
                            @endforeach
                          </datalist>
                        </div>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-agregar-institucion">+ Crear</button>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Intensidad horaria (semanal)<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="intensidad" name="intensidad" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Promedio acumulativo<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="promedio" name="promedio" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>



                      <div class="form-group">
                        <label for="fecha_inicio" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha inicio</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">      
                          <input id="fecha_inicio" name="fecha_inicio" type="date" class="form-control col-md-7 col-xs-12" placeholder="Fecha inicio">
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="fecha_fin" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha fin</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">      
                          <input id="fecha_fin" name="fecha_fin" type="date" class="form-control col-md-7 col-xs-12" placeholder="fecha fin">
                        </div>
                      </div>

       
          
            
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button type="submit" class="btn btn-success btn-lg">Guardar</button>
        </div>
      </div>
          </form>
          <!-- formulario-->
        </div>
      </div>
    </div>
</div>

<div id="modal-agregar-institucion" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Agregar Institución</h4>
        </div>
        <div class="modal-body">
          <!-- formulario-->
          <form data-parsley-validate class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nombre <span class="required">*</span>
          </label>
          <div class="col-md-10 col-sm-10 col-xs-12">
            <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
          </div>
            </div>

            <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">País</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <select class="form-control">
            <option>Elije una opción</option>
            <option>Option one</option>
            <option>Option two</option>
            <option>Option three</option>
            <option>Option four</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Ciudad</label>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <select class="form-control">
            <option>Elije una opción</option>
            <option>Option one</option>
            <option>Option two</option>
            <option>Option three</option>
            <option>Option four</option>
          </select>
        </div>
      </div>

      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button type="submit" class="btn btn-success btn-lg">Guardar</button>
        </div>
      </div>
          </form>
          <!-- formulario-->
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
    $(".update-info-form").click(function(){
        $("#input-put-form").replaceWith("<input id='input-put-form' type='hidden' name='_method' value='PUT'>");
        $("#formacion_id").val($(this).val());
        getFormacionAcademica($(this).val(),2);
    });

    $("#lista-institucion").change(function(){
        $("#institucion_id").val($("#datalistOptions option[value='"+$(this).val()+"']").data('value'));
    });

    $(".view-info-form").click(function(){
        $("#modal-view-academica .modal-body").empty();
        getFormacionAcademica($(this).val(),1);
    });
    var elementoSeleccionado;

    $(".btn-del-form").click(function(){
        elementoSeleccionado=$(this);
    });

    $("#btn-elim-form").click(function(){
        eliminarFormacion(elementoSeleccionado.val(),elementoSeleccionado);
    });

    $("#btn-add-formacion").click(function(){
        $("#formacion_id").val("");
         $("#input-put-form").replaceWith("<input id='input-put-form' type='hidden'>");
    });



    function getFormacionAcademica(formacion_id,opcion){
            $.ajax({
            url:'/curriculum/datos-generales/formacion-academica/'+formacion_id,
            method:'GET',
            beforeSend:function(){
                ActivarEfectoCargaPagina();
            },
            complete:function(){
                DesactivarEfectoCargaPagina();
            },
            success: function(data){
                if(data){
                    if(opcion==1){
                          if(data[0].nivel){
                            $("#modal-view-academica .modal-body").append("<h4>Nivel de formación</h4><p>"+data[0].nivel+"</p>");
                          }
                          if(data[0].titulo){
                            $("#modal-view-academica .modal-body").append("<h4>Título obtenido</h4><p>"+data[0].titulo+"</p>");
                          }
                          if(data[0].institucion){
                            $("#modal-view-academica .modal-body").append("<h4>Institución</h4><p>"+data[0].institucion+"</p>");
                          }
                          if(data[0].fecha_inicio){
                            $("#modal-view-academica .modal-body").append("<h4>Fecha de inicio</h4><p>"+data[0].fecha_inicio+"</p>");
                          }
                          if(data[0].fecha_fin){
                            $("#modal-view-academica .modal-body").append("<h4>Fecha de finalización</h4><p>"+data[0].fecha_fin+"</p>");
                          }
                          if(data[0].intensidad){
                            $("#modal-view-academica .modal-body").append("<h4>Intensidad horaria(semanal)</h4><p>"+data[0].intensidad+"</p>");
                          }
                          if(data[0].promedio){
                            $("#modal-view-academica .modal-body").append("<h4>Promedio acumulativo de los periodos cursados</h4><p>"+data[0].promedio+"</p>");
                          }
                    }
                    else if(opcion==2){
                        $("#nivel_id").val(data[0].nivel_id);
                        $("#titulo").val(data[0].titulo);
                        $("#lista-institucion").val(data[0].institucion);
                        $("#institucion_id").val(data[0].institucion_id);
                        $("#intensidad").val(data[0].intensidad);
                        $("#promedio").val(data[0].promedio);
                        $("#fecha_inicio").val(data[0].fecha_inicio);
                        $("#fecha_fin").val(data[0].fecha_fin);
                    }
                }
                else{
                    mensajeError("No se pudo obtener la información");
                }
            },
            error:function(){
                mensajeError("Ha ocurrido un error, la acción no se ha realizado");
            }
        });
    }

    function eliminarFormacion(formacion_id_del,elemento){
            $.ajax({
            url:'/curriculum/datos-generales/formacion-academica',
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
                    mensajeError("No se pudo obtener la información");
                }
            },
            error:function(){
                mensajeError("Ha ocurrido un error, la acción no se ha realizado");
            }
        });
    }
 </script>
@endsection