@section('estilos')
<style>
  #semilleristas-list .semillerista{
    -webkit-box-shadow: 0px 6px 10px 0px rgb(0 0 0 / 14%), 0px 1px 18px 0px rgb(0 0 0 / 12%), 0px 3px 5px -1px rgb(0 0 0 / 20%);
    box-shadow: 0px 6px 10px 0px rgb(0 0 0 / 14%), 0px 1px 18px 0px rgb(0 0 0 / 12%), 0px 3px 5px -1px rgb(0 0 0 / 20%);
    padding: 15px;
    margin: 0 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4%;
  }

  #semilleristas-list .semillerista .delete{
    border: none;
    background: none;
    font-size: 1.4em;
  }

  #semilleristas-list .semillerista .userinfo{
    font-weight: bold;
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
                <h2><strong>Semillero:</strong> {{$infoGeneral[0]->nombre}}</h2>
                @if($privilegio=="admin" || $privilegio=="codirector")
                  <ul class="nav navbar-right panel_toolbox">
                    <li class="dropdown right">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="{{Request::url()."/editar"}}">Editar</a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                @endif
                <div class="clearfix"></div>
            </div>


            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Información general</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Participantes</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Actividades</a>
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
                                        <label class="control-label col-md-3">Código:</label>
                                        <p style="margin-top:7px" class="col-md-9">{{$infoGeneral[0]->codigo}}</p>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <label class="control-label col-md-3">Titulo:</label>
                                        <p style="margin-top:7px" class="col-md-9">{{$infoGeneral[0]->nombre}}</p>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <label class="control-label col-md-3">Fecha inicio:</label>
                                        <p style="margin-top:7px" class="col-md-9">{{$infoGeneral[0]->fecha_inicio}}</p>
                                    </div>

                                </div>

                          </div>
                        </div>
                      </div>
                      <!--<div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Documentación</h4>
                        </a>
                        <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <p><strong>Documentos cargados</strong></p>
                            <div>
                              <ul class="list-group">                                


                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>-->
                      <!--<div class="panel">
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
                      </div>-->

                    </div>
                    <!-- end of accordion -->
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                    <!-- start accordion -->
                    <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne2" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Encargados</h4>
                        </a>
                        <div id="collapseOne2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
  
                          <div class="panel-body">
                            @foreach($encargados as $encargado)

                              <div class="col-md-5 col-sm-5 col-xs-12 profile_details">
                                <div class="well profile_view">
                                  <div class="col-sm-12">
                                    <h4 class="brief"><i>{{$encargado->funcion}}</i></h4>
                                    <div class="left col-xs-7">
                                      <h2>{{$encargado->nombres}}</h2>
                                      <h2>{{$encargado->apellidos}}</h2>
                                    <!-- <ul class="list-unstyled">
                                        <li><i class="fa fa-building"></i> Address: </li>
                                        <li><i class="fa fa-phone"></i> Phone #: </li>
                                      </ul>-->
                                    </div>
                                    <div class="right col-xs-5 text-center">
                                      <img src="{{isset($encargado->foto) ? asset('storage/'.$encargado->foto):asset('images/user.png')}}" alt="" class="img-circle img-responsive">
                                    </div>
                                  </div>
                                  <div class="col-xs-12 bottom text-center">
                                    <div class="col-xs-12 col-sm-6 emphasis">
                                        <!-- otro boton por aca-->
                                    </div>
                                    <div class="col-xs-12 col-sm-6 emphasis">
                                      <!--<button type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-user"> </i> Ver Perfil
                                      </button>-->
                                    </div>
                                  </div>
                                </div>
                              </div> 

                            @endforeach
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo2" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Semilleristas</h4>
                        </a>
                        <div id="collapseTwo2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          @if($privilegio=="admin" || $privilegio=="lider" || $privilegio=="coordinador" || $privilegio=="codirector")
                            <button type="button" class="btn-agregar btn btn-primary" data-toggle="modal" data-target="#modal-agregar-semilleristas">+ Agregar</button>
                          @endif
                          <div class="panel-body">
                            @foreach($semilleristasInt as $semillerista)
                              <div class="col-md-5 col-sm-5 col-xs-12 profile_details">
                                <div class="well profile_view">
                                  <div class="col-sm-12">
                                    <h4 class="brief"><i>{{$semillerista->funcion}}</i></h4>
                                    <div class="left col-xs-7">
                                      <h2>{{$semillerista->nombres}}</h2>
                                      <h2>{{$semillerista->apellidos}}</h2>
                                    <!-- <ul class="list-unstyled">
                                        <li><i class="fa fa-building"></i> Address: </li>
                                        <li><i class="fa fa-phone"></i> Phone #: </li>
                                      </ul>-->
                                    </div>
                                    <div class="right col-xs-5 text-center">
                                      <img src="{{isset($semillerista->foto) ? asset('storage/'.$semillerista->foto):asset('images/user.png')}}" alt="" class="img-circle img-responsive">
                                    </div>
                                  </div>
                                  <div class="col-xs-12 bottom text-center">
                                    <div class="col-xs-12 col-sm-6 emphasis">
                                        <!-- otro boton por aca-->
                                    </div>
                                    <div class="col-xs-12 col-sm-6 emphasis">
                                      <!--<button type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-user"> </i> Ver Perfil
                                      </button>-->
                                    </div>
                                  </div>
                                </div>
                              </div> 
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion -->


                </div>

                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">

                  @if($privilegio=="admin" || $privilegio=="lider" || $privilegio=="coordinador" || $privilegio=="codirector")
                    <div class="btn-group">
                      <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-md" type="button" aria-expanded="false">Crear <span class="caret"></span>
                      </button>
                      <ul role="menu" class="dropdown-menu">
                        <li><a href="javaScript:void(0)" data-toggle="modal" data-target="#modal-agregar-actividad">Crear actividad</a></li>
                        <!--<li class="divider"></li>
                        <li><a href="#">Separated link</a></li>-->
                      </ul>
                      </div>
                  @endif

                  <div id="modal-agregar-actividad" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Actividad</h4>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="/semilleros/semillero/{{$infoGeneral[0]->codigo}}/actividad" data-parsley-validate class="form-horizontal form-label-left">
                            @csrf
                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Título <span class="required">*</span>
                          </label>
                          <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" name="titulo" class="form-control col-md-7 col-xs-12" required="required">
                          </div>
                            </div>

                          <div class="form-group">
                        <label for="fecha_entrega" class="control-label col-md-2 col-sm-2 col-xs-12">Fecha de entrega</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">      
                          <input name="fecha_entrega" type="date" class="form-control has-feedback-left col-md-7 col-xs-12" placeholder="fecha_limite">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                      </div>

                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Instrucciones
                          </label>
                          <div class="col-md-10 col-sm-10 col-xs-12">

                          <textarea class="form-control" name="instrucciones"></textarea>

                          </div>
                            </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
                        </div>
                      </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- start lista de actividades-->
                  <div class="list-activity">
                    @foreach($actividades as $actividad)
                    <div class="activity-item">
                      <a href="/semilleros/semillero/{{$infoGeneral[0]->codigo}}/actividad/{{$actividad->codigo}}">
                        <i style="margin-right: 15px;" class="fa fa-book"></i>
                        {{$actividad->titulo}}
                      </a>
                      <!--<div role="presentation" class="dropdown">
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
                      </div>-->
                    </div>
                    @endforeach
                  </div>
                  <!-- end lista de actividades-->
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>


<div id="modal-agregar-semilleristas" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" >Agregar semilleristas</h4>
      </div>
      <div class="modal-body">
        <!-- formulario-->
        <form id="form-agregar-semilleristas" data-parsley-validate class="form-horizontal form-label-left">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Buscar:
        </label>
        <div class="col-md-10 col-sm-10 col-xs-12">
          <input id="semillerista-search" class="form-control col-md-7 col-xs-12" list="datalistSemilleristas" type="text" autocomplete="off">
          <datalist id="datalistSemilleristas">
            @foreach ($semilleristas as $semillerista)
              <option data-value="{{$semillerista->id}}" data-nombres="{{$semillerista->nombres}}" data-apellidos="{{$semillerista->apellidos}}" data-foto="{{$semillerista->foto}}" value="{{$semillerista->usuario}}"></option>
            @endforeach
          </datalist>
        </div>
          </div>
          <div id="semilleristas-list">

          </div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <button id="btn-cancelar-semillerista" data-dismiss="modal" type="button" class="btn btn-default">Cancelar</button>
        <button  id="btn-agregar-semillerista" data-dismiss="modal" type="button" class="btn btn-success">Agregar integrante(s)</button>
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
    <script>
      $("#form-agregar-semilleristas").submit(function(e){
        e.preventDefault();
      });
      $("#semillerista-search").change(function(){
        var option=$("#datalistSemilleristas option[value='"+$(this).val()+"']");
        if(!(option.data('value')==$("#semilleristas-list .semillerista input[value='"+option.data('value')+"']").val())){
          $("#semilleristas-list").prepend("<div class='semillerista' data-nombres='"+option.data('nombres')+"' data-apellidos='"+option.data('apellidos')+"' data-foto='"+option.data('foto')+"'><input type='hidden' name='usuario_id[]' value='"+option.data('value')+"' /><div class='userinfo'><span>"+$(this).val()+"</span></div><div><button type='button' class='delete'><span class='fa fa-times-circle'></span></button></div></div>");
          $("#semilleristas-list .semillerista .delete").click(function(){
            $(this).parent().parent().remove();
          });
        }
        $(this).val('');
      });
      $("#btn-agregar-semillerista").click(function(){
        //$("#semilleristas-list").prepend("<div class='semillerista'><div class='userinfo'><span>Jesus Maria  Suarez | CC. 1232892648</span></div><div><button type='button' class='delete'><span class='fa fa-times-circle'></span></button></div></div>");
        agregarSemilleristas(new FormData($('#form-agregar-semilleristas')[0]));
      });

      $("#btn-cancelar-semillerista").click(function(){
        $("#semilleristas-list").empty();
      });

      function resetearSemilleristas(){
        $("#datalistSemilleristas").empty();
        $.ajax({
            url:'/semilleros/semillero/{{$infoGeneral[0]->codigo}}/semilleristas',
            beforeSend:function(){
                ActivarEfectoCargaPagina();
            },
            complete:function(){
                DesactivarEfectoCargaPagina();
            },
            method:'GET',
            success: function(data){
                if(data){
                  $.each(data, function (ind, elem){ 
                      $("#datalistSemilleristas").append("<option data-value='"+elem['id']+"' data-nombres='"+elem['nombres']+"' data-apellidos='"+elem['apellidos']+"' data-foto='"+elem['foto']+"' value='"+elem['usuario']+"'></option>");
                  });
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
      
      function agregarSemilleristas(formulario){
        $.ajax({
            url:'/semilleros/semillero/{{$infoGeneral[0]->codigo}}/semilleristas',
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
                if(data){
                    $.each($("#semilleristas-list .semillerista"), function (ind, elem){
                      var nom=$(elem).data('nombres');
                      var ape=$(elem).data('apellidos');
                      var foto;
                      if($(elem).data('foto')=="" || $(elem).data('foto')==null){
                        foto="{{asset('images/user.png')}}";
                      }
                      else{
                        foto="/storage/"+$(elem).data('foto');
                      }
                      $("#collapseTwo2 .panel-body").append("<div class='col-md-5 col-sm-5 col-xs-12 profile_details'><div class='well profile_view'><div class='col-sm-12'><h4 class='brief'><i>Semillerista</i></h4><div class='left col-xs-7'><h2>"+nom+"</h2><h2>"+ape+"</h2></div><div class='right col-xs-5 text-center'><img src='"+foto+"' alt='' class='img-circle img-responsive'></div></div><div class='col-xs-12 bottom text-center'><div class='col-xs-12 col-sm-6 emphasis'></div><div class='col-xs-12 col-sm-6 emphasis'></div></div></div></div>");
                    }); 
                    resetearSemilleristas();
                    $("#semilleristas-list").empty();
                }
                else{
                   $("#semilleristas-list").empty();
                    mensajeError("Los semilleristas no se pudieron agregar");
                }
            },
            error:function(){
                $("#semilleristas-list").empty();
                mensajeError("Ha ocurrido un error, la acción no se ha realizado");
            }
        });
      }
    </script>
@endsection
