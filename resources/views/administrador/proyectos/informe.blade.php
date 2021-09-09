@extends('administrador.dashboard')
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
                        <form method="post" action="/entregar-informe" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$informacion[0]->id}}" name="informe_id">
                            <input id="carga-archivos" type="file" name="archivos[]" multiple>
                            <button id="btn-add" type="button" class="btn btn-default">+ Añadir archivos</button>
                            <button type="submit" class="btn btn-dark">Subir archivos</button>
                        </form>  
                    </div>

                    <div class="files-upload">
                        @foreach($archivos as $archivo)
                        <div class="file">
                            <a href="/descargar/archivo-informe/{{$archivo->ruta}}/{{$archivo->nombre}}"><i class="fa fa-download"></i> {{$archivo->nombre}}</a>
                            <button class="delete-file" value="{{$archivo->ruta}}" data-toggle="modal"><span class="fa fa-remove remove"></span></button>    
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
            url:'/informe/eliminar-archivo',
            data: {
              ruta:ruta
            },
            method:'POST',
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