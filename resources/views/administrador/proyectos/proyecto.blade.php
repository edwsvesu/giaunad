@extends('administrador.dashboard')
@section('estilos')
<!-- Switchery -->
<link href="{{asset('css/switchery.min.css')}}" rel="stylesheet">
<!--PNotify--> 
<link href="{{asset('css/pnotify.css')}}" rel="stylesheet">
<link href="{{asset('css/pnotify.buttons.css')}}" rel="stylesheet">
<link href="{{asset('css/pnotify.nonblock.css')}}" rel="stylesheet">
<style>
  .fa-download{
    margin-right: 5px;
  }

  .delete-file-doc{
    float: right;
    margin: 0;
    font-size: 1.3em;
  }

  .list-group .list-group-item{
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .list-group .list-group-item a{
    cursor: pointer;
    font-size: 1.1em;
  }

  .btn-agregar{
    margin-top: 10px;
    margin-left: 25px;
  }
</style>
@endsection
@section('contenido')
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Titulo del proyecto</h2>
                <div class="clearfix"></div>
            </div>


            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Información general</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Participantes</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Plan y ejecución</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    <!-- start accordion -->
                    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Datos generales</h4>
                        </a>
                        <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <div class="form-horizontal form-label-left">

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <label class="control-label col-md-3">Titulo:</label>
                                        <p style="margin-top:7px" class="col-md-9">{{$infoGeneral[0]->titulo}}</p>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <label class="control-label col-md-3">Tipo de proyecto:</label>
                                        <p style="margin-top:7px" class="col-md-9">{{$infoGeneral[0]->tipo}}</p>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <label class="control-label col-md-3">Fecha inicio:</label>
                                        <p style="margin-top:7px" class="col-md-9">{{$infoGeneral[0]->fecha_inicio}}</p>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <label class="control-label col-md-3">Fecha fin:</label>
                                        <p style="margin-top:7px" class="col-md-9">{{($infoGeneral[0]->fecha_fin)?$infoGeneral[0]->fecha_fin:"No especificada"}}</p>
                                    </div>
                                </div>

                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Documentación</h4>
                        </a>
                        <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <p><strong>Documentos cargados</strong></p>
                            <div>
                              <ul class="list-group">
                                <li class="list-group-item control-upload">
                                  <form id="form-upload">
                              <input id="input-upload" type="file" name="documentos[]" multiple>
                              <input type="hidden" value="{{$infoGeneral[0]->id}}" name="proyecto_id">
                                 </form>
                              <button id="btn-upload"><span class="fa fa-upload"></span></button>
                                </li>
                              @if($documentos)
                                  @foreach($documentos as $documento)
                                    <li class="list-group-item"><div><a href="/descargar/documento-proyecto/{{$documento->ruta}}/{{$documento->nombre}}" target="_blank"><span class="fa fa-download"></span>{{$documento->nombre}}</a></div> <button value="{{$documento->ruta}}" class="delete-file-doc" data-toggle="modal" data-target="#modal-borrar-documento"><span class="fa fa-trash"></span></button></li>
                                  @endforeach
                              @else
                                <p id="sin-info">No se ha cargado ningún documento</p>
                              @endif
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree1" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title">Mas informacion</h4>
                        </a>
                        <div id="collapseThree1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <p><strong>Collapsible Item 3 data</strong>
                            </p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion -->
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                    <!-- start accordion -->
                    <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne2" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Equipo de investigación</h4>
                        </a>
                        <div id="collapseOne2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                 <button type="button" class="btn-agregar btn btn-primary" data-toggle="modal" data-target="#modal-agregar-integrante">+ Agregar</button>
                          <div class="panel-body">
                            <div class="col-md-6 col-sm-6 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>Integrante</i></h4>
                            <div class="left col-xs-7">
                              <h2>Nicole Pearson</h2>
                              <p><strong>About: </strong> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Address: </li>
                                <li><i class="fa fa-phone"></i> Phone #: </li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="{{asset('images/img.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                                <!-- otro boton por aca-->
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> Ver Perfil
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>   



                    <div class="col-md-6 col-sm-6 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>Investigador</i></h4>
                            <div class="left col-xs-7">
                              <h2>Nicole Pearson</h2>
                              <p><strong>About: </strong> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Address: </li>
                                <li><i class="fa fa-phone"></i> Phone #: </li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="{{asset('images/img.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                                <!-- otro boton por aca-->
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> Ver Perfil
                              </button>
                            </div>
                          </div>
                        </div>
                      </div> 




                        <div class="col-md-6 col-sm-6 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>Estudiante</i></h4>
                            <div class="left col-xs-7">
                              <h2>Nicole Pearson</h2>
                              <p><strong>About: </strong> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Address: </li>
                                <li><i class="fa fa-phone"></i> Phone #: </li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="{{asset('images/img.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                                <!-- otro boton por aca-->
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> Ver Perfil
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>   





                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo2" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Mas informacion</h4>
                        </a>
                        <div id="collapseTwo2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <p><strong>Collapsible Item 2 data</strong>
                            </p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree2" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree2" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title">Mas informacion</h4>
                        </a>
                        <div id="collapseThree2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <p><strong>Collapsible Item 3 data</strong>
                            </p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion -->


                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                  <!--modal-->



                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar-tarea">+ Crear</button>

                  <div id="modal-agregar-tarea" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Actividad</h4>
                        </div>
                        <div class="modal-body">


                          <!-- formulario de tarea-->



                          <form data-parsley-validate class="form-horizontal form-label-left">
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Título <span class="required">*</span>
                          </label>
                          <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                            </div>

                          <div class="form-group">
                        <label for="fecha_inicio" class="control-label col-md-2 col-sm-2 col-xs-12">Fecha de entrega</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">      
                          <input name="fecha_fin" type="text" class="form-control has-feedback-left col-md-7 col-xs-12" id="single_cal4" placeholder="First Name">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            <input id="fecha_nula" type="checkbox" class="js-switch" checked />
                        </label>
                      </div>

                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Instrucciones
                          </label>
                          <div class="col-md-10 col-sm-10 col-xs-12">

                          <textarea id="instrucciones" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>

                          </div>
                            </div>


                          <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Adjuntar archivos
                            </label>
                          <div class="col-md-10 col-sm-10 col-xs-12">
                            <input style="height: 100%;" type="file">
                          </div>
                            </div> 


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success btn-lg">Asignar actividad</button>
                        </div>
                      </div>

                          </form>

                          <!-- formulario de tarea-->
                        </div>
                      </div>
                    </div>
                  </div>


                  <!-- modal-->

                  <!-- start lista de actividades-->

                  <div class="list-activity">
                    <div class="activity-item">
                      <a href="/entrega">
                        <i style="margin-right: 15px;" class="fa fa-book"></i>
                        Primer informe de proyecto
                      </a>

                      <div role="presentation" class="dropdown">
                      <div class="activity-options dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                  <span class="fa fa-ellipsis-v"></span>
                              </div>
                      <ul class="dropdown-menu animated fadeInDown" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Action</a>
                        </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Another action</a>
                        </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Something else here</a>
                        </li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Separated link</a>
                        </li>
                      </ul>
                      </div>

                    </div>



                    <div class="activity-item">
                      <a href="#">
                        <i style="margin-right: 15px;" class="fa fa-book"></i>
                        Primer informe de proyecto crrinrf
                      </a>

                      <div role="presentation" class="dropdown">
                      <div class="activity-options dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                  <span class="fa fa-ellipsis-v"></span>
                              </div>
                      <ul class="dropdown-menu animated fadeInDown" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Action</a>
                        </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Another action</a>
                        </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Something else here</a>
                        </li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Separated link</a>
                        </li>
                      </ul>
                      </div>
                    </div>


                                        <div class="activity-item">
                      <a href="#">
                        <i style="margin-right: 15px;" class="fa fa-book"></i>
                        Primer informe de proyecto crrinrf
                      </a>

                      <div role="presentation" class="dropdown">
                      <div class="activity-options dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                  <span class="fa fa-ellipsis-v"></span>
                              </div>
                      <ul class="dropdown-menu animated fadeInDown" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Action</a>
                        </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Another action</a>
                        </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Something else here</a>
                        </li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Separated link</a>
                        </li>
                      </ul>
                      </div>
                    </div>


                                        <div class="activity-item">
                      <a href="#">
                        <i style="margin-right: 15px;" class="fa fa-book"></i>
                        Primer informe de proyecto crrinrf
                      </a>

                      <div role="presentation" class="dropdown">
                      <div class="activity-options dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                  <span class="fa fa-ellipsis-v"></span>
                              </div>
                      <ul class="dropdown-menu animated fadeInDown" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Action</a>
                        </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Another action</a>
                        </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Something else here</a>
                        </li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="https://twitter.com/fat">Separated link</a>
                        </li>
                      </ul>
                      </div>
                    </div>






                  </div>

                  </div>



                  <!-- end lista de actividades-->

                </div>
              </div>
            </div>
        </div>
    </div>
</div>


<div id="modal-borrar-documento" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Borrar documento</h4>
        </div>
        <div class="modal-body">
          <h4>¿Está seguro que desea eliminar el documento seleccionado? </h4>
          <p>Si continua con esta acción se eliminará permanentemente, pulse <strong>ACEPTAR</strong> para continuar.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
          <button id="btnElimnarDocumento" type="button" class="btn btn-primary" data-dismiss="modal">ACEPTAR</button>
        </div>
      </div>
    </div>
</div>




<div id="modal-agregar-integrante" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Nuevo integrante del proyecto</h4>
                        </div>
                        <div class="modal-body">
                          <!-- formulario-->
                          <form data-parsley-validate class="form-horizontal form-label-left">
                            <input id="proyecto_id_integrante" value="{{$infoGeneral[0]->id}}" type="hidden" name="proyecto_id">
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-2 col-xs-12">Integrante
                          </label>
                          <div class="col-md-10 col-sm-10 col-xs-12">
                            <input id="integranteinfo" class="form-control col-md-7 col-xs-12" list="datalistIntegrantes" type="text" autocomplete="off">
                            <input id="integrante_id_send" type="hidden" name="usuario_id">
                            <datalist id="datalistIntegrantes">
                              @foreach($integrantesAgregar as $item)
                                <option data-value="{{$item->id}}" value="{{$item->usuario}}"></option>
                              @endforeach
                          </datalist>
                          </div>
                            </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button data-dismiss="modal" id="btn-agregar-integrante" type="submit" class="btn btn-success btn-lg">Agregar integrante</button>
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
    <!-- jQuery Knob -->
    <script src="{{asset('js/jquery.knob.min.js')}}"></script>
    <!-- Switchery -->
    <script src="{{asset('js/switchery.min.js')}}"></script>
     <!-- PNotify -->
<script src="{{asset('js/pnotify.js')}}"></script>
<script src="{{asset('js/pnotify.buttons.js')}}"></script>
<script src="{{asset('js/pnotify.nonblock.js')}}"></script>
    <script>
      var documentoSeleccionado;
      $("#btn-upload").click(function(){
        subirDocumentos(new FormData($('#form-upload')[0]));
      });

      $("#btn-agregar-integrante").click(function(e){
        e.preventDefault();
          agregarIntegrante($("#proyecto_id_integrante").val(),$("#integrante_id_send").val());
      });

      $(".delete-file-doc").click(function(){
          documentoSeleccionado=$(this);
      });

      $("#btnElimnarDocumento").click(function(){
          borrarDocumento(documentoSeleccionado.val(),documentoSeleccionado);
      });

      $("#integranteinfo").change(function(){
        $("#integrante_id_send").val($("#datalistIntegrantes option[value='"+$(this).val()+"']").data('value'));
      });

      function agregarIntegrante(proyecto_id,usuario_id){
          $.ajax({
            url:'/proyectos/agregar-integrante',
            data: {
              proyecto_id:proyecto_id,
              usuario_id:usuario_id
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
                  $('#modal-agregar-integrante form')[0].reset();
                  $('#modal-agregar-integrante form')[0].reset();
                }
                else{
                    mensajeError("El documento no se pudo borrar");
                }
            },
            error:function(){
                mensajeError("Ha ocurrido un error, la acción no se ha realizado");
            }
          });        
      }


      function borrarDocumento(ruta,elemento){
            $.ajax({
            url:'/proyectos/eliminar-documento',
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
                    mensajeError("El documento no se pudo borrar");
                }
            },
            error:function(){
                mensajeError("Ha ocurrido un error, la acción no se ha realizado");
            }
        });
      }


      function subirDocumentos(formulario){
        $.ajax({
            url:'/subir/documento-proyecto',
            data: formulario,
            processData: false,
            contentType: false,
            method:'POST',
            beforeSend:function(){
                ActivarEfectoCargaPagina();
            },
            complete:function(){
                DesactivarEfectoCargaPagina();
            },
            success: function(data){
                if(data!=0){
                    $("#sin-info").remove();
                    $.each(data, function (ind, elem){ 
                      $(".list-group").append("<li class='list-group-item'><div><a href='/descargar/documento-proyecto/"+elem['ruta']+"/"+elem['nombre']+"' target='_blank'><span class='fa fa-download'></span>"+elem['nombre']+"</a></div> <button value='"+elem['ruta']+"' class='delete-file-doc' data-toggle='modal' data-target='#modal-borrar-documento'><span class='fa fa-trash'></span></button></li>");
                    }); 
                    $('#form-upload')[0].reset();
                    $(".delete-file-doc").click(function(){
                      documentoSeleccionado=$(this);
                    });
                }
                else{
                    mensajeError("Los archivos no se pudieron subir");
                }
            },
            error:function(){
                mensajeError("Ha ocurrido un error, la acción no se ha realizado");
            }
        });
      }

      function mensajeError(mensaje){
        new PNotify({
          title: 'Error',
          text: mensaje,
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