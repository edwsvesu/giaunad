@section('estilos')
<link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<style>
    .activity-details{
        width: 60%;
        padding-right: 30px;
    }

    .activity-details .info{
        font-size: 15px;
        border-bottom: 1px dashed;
        margin-bottom: 10px;
        padding-bottom: 15px;
    }

    .activity-details .file{
        display: flex;
        align-items: center;
        padding: 8px;
    }

    .activity-details .file a{
        margin-right: 10px;
    }

    .activity-details .file .remove{
        font-size: 17px;
        cursor: pointer;
    }

    .activity-deliveries .header{
        text-align: center;
        margin-bottom: 5vh;
    }

    .section-activity-deliveries{
        display: flex;
        flex-wrap: wrap;
    }

    .activity-deliveries{
        width: 40%;
    }

    .activity-deliveries-container{
        box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -webkit-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -moz-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -ms-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        border-radius: 0.5rem;
        padding: 15px;
    }

    .files-upload .file{
        text-align: center;
        font-size: 1.2em;
        margin-bottom: 10px;
    }

    .files-upload .file .delete-file{
        margin-left: 15px;
    }

    #carga-archivos{
       display: none;
    }


</style>
@endsection
@section('contenido')
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-book"></i> {{$informacion[0]->titulo}}</h2>
                @if($privilegio=="admin" || $privilegio=="codirector" || $privilegio=="lider")
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="dropdown right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" data-toggle="modal" data-target="#modal-agregar-tarea">Editar</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modal-del-informe">Eliminar</a></li>
                        </ul>
                        </li>
                    </ul>
                @endif
                <div class="clearfix"></div>
            </div>
            <div class="section-activity-deliveries">
                <!--comienzo seccion de detalle de la actividad -->
                <div class="activity-details">
                    <!--comienzo info general -->
                    <div class="info">
                        <div>Fecha de entrega: {{$informacion[0]->fecha_limite ? $informacion[0]->fecha_limite: 'No especificada'}}</div>
                    </div>
                    <!--fin info general-->

                    <!--comienzo instrucciones y soporte-->
                    <div>
                        <p>{{$informacion[0]->descripcion ? $informacion[0]->descripcion:'Sin descripción'}}</p>
                    </div>
                    <!--fin instrucciones y soporte-->

                </div>
                <!--fin seccion de detalle de la actividad -->

                <!-- inicio seccion de entregas de la actividad-->
                <div class="activity-deliveries">
                   <div class="activity-deliveries-container"> 
                    <div class="header">
                        <h2>Archivos</h2>
                        @if($privilegio=="lider" || $privilegio=="admin" || $privilegio=="codirector")
                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{$informacion[0]->id}}" name="informe_id">
                                <input id="carga-archivos" type="file" name="archivos[]" multiple>
                                <button id="btn-add" type="button" class="btn btn-default">+ Añadir archivos</button>
                                <button type="submit" class="btn btn-dark">Subir archivos</button>
                            </form>  
                        @endif
                    </div>

                    <div class="files-upload">
                        @foreach($archivos as $archivo)
                        <div class="file">
                            <a href="/descargar/archivo-informe/{{$archivo->ruta}}/{{$archivo->nombre}}"><i class="fa fa-download"></i> {{$archivo->nombre}}</a>
                            @if($privilegio=="lider" || $privilegio=="admin" || $privilegio=="codirector")
                                <button class="delete-file" value="{{$archivo->ruta}}" data-toggle="modal"><span class="fa fa-remove remove"></span></button>
                            @endif    
                        </div>
                        @endforeach
                    </div>
                </div>
                </div>
                <!-- fin de seccion de entregas de la actividad-->
            </div>
		</div>
	</div>
</div>

<div id="modal-agregar-tarea" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Editar Informe</h4>
        </div>
        <div class="modal-body">
          <!-- formulario de tarea-->
          <form method="post" action="" data-parsley-validate class="form-horizontal form-label-left">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Título <span class="required">*</span>
          </label>
          <div class="col-md-10 col-sm-10 col-xs-12">
            <input type="text" name="titulo" value="{{$informacion[0]->titulo}}" class="form-control col-md-7 col-xs-12" required="required" maxlength="90">
          </div>
            </div>

          <div class="form-group">
        <label for="fecha_inicio" class="control-label col-md-2 col-sm-2 col-xs-12">Fecha de entrega</label>
        <div class="col-md-3 col-sm-3 col-xs-12">      
          <input name="fecha_limite" type="date" value="{{$informacion[0]->fecha_limite}}" class="form-control has-feedback-left col-md-7 col-xs-12" placeholder="fecha_limite">
          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
        </div>
      </div>

            <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Descripción
          </label>
          <div class="col-md-10 col-sm-10 col-xs-12">

          <textarea id="instrucciones" class="form-control" name="descripcion" maxlength="1000">{{$informacion[0]->descripcion}}</textarea>

          </div>
            </div>
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <a href="" class="btn btn-default btn-lg">Cancelar</a>
          <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
        </div>
      </div>

          </form>

          <!-- formulario de tarea-->
        </div>
      </div>
    </div>
  </div>

  <div id="modal-del-informe" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Eliminar informe</h4>
        </div>
        <div class="modal-body">
          <h4>¿Está seguro que desea eliminar el informe?</h4>
          <p>Si continua con esta acción se eliminará permanentemente, pulse <strong>ACEPTAR</strong> para continuar.</p>
        </div>
        <div class="modal-footer">
          <form action="" method="post">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
            <button id="btn-elim-form" type="submit" class="btn btn-danger">ACEPTAR</button>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    $("#btn-add").click(function(){
        $("#carga-archivos").focus().trigger("click");
    });

    $(".delete-file").click(function(){
          borrarArchivo($(this).val(),$(this));
    });

    function borrarArchivo(ruta,elemento){
            $.ajax({
            url:'/proyectos/proyecto/{{$informacion[0]->proyecto_cod}}/informe/{{$informacion[0]->id}}/archivo',
            data: {
              ruta:ruta
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
                  $(elemento).parent().remove();
                }
                else{
                    mensajeError("El Archivo no se pudo borrar");
                }
            },
            error:function(){
                mensajeError("Ha ocurrido un error, la acción no se ha realizado");
            }
        });
    }
</script>
@endsection