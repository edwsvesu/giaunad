@extends('administrador.dashboard')
@section('estilos')
<!-- bootstrap-daterangepicker -->
<link href="{{asset('css/daterangepicker.css')}}" rel="stylesheet">
<!-- Switchery -->
<link href="{{asset('css/switchery.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
<div class="clearfix"></div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Formación académica</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nivel de formación</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control">
                              <option value="" selected>Nivel de formación</option>
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
                          <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="lider" class="control-label col-md-3 col-sm-3 col-xs-12">Institución</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="listaaa" class="form-control col-md-7 col-xs-12" list="datalistOptions" type="text" name="middle-name" required="required">
                          <datalist id="datalistOptions">
                              <option data-value="155" value="InternetExplorer"></option>
                              <option data-value="22" value="Firefox"></option>
                              <option data-value="34" value="Chrome"></option>
                          </datalist>
                          <input type="hidden" id="edwinsito" name="example">
                        </div>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-agregar-institucion">+ Crear</button>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Intensidad horaria (semanal)<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Promedio acumulativo<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>



                      <div class="form-group">
                        <label for="fecha_inicio" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha inicio</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">      
                          <input name="fecha_inicio" type="text" class="form-control has-feedback-left col-md-7 col-xs-12" id="single_cal1" placeholder="First Name">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="fecha_inicio" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha fin</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">      
                          <input name="fecha_fin" type="text" class="form-control has-feedback-left col-md-7 col-xs-12" id="single_cal4" placeholder="First Name">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <label class="col-md-3 col-sm-3 col-xs-12">
                            <input id="fecha_nula" type="checkbox" class="js-switch" checked />
                        </label>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						              <button class="btn btn-primary" type="reset">Limpiar</button>
                          <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

            <div id="modal-agregar-institucion" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
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
    <!-- bootstrap-datetimepicker -->   
    <script src="{{asset('js/moment.min.js')}}"></script> 
    <script src="{{asset('js/daterangepicker.js')}}"></script>
    <!-- jQuery Knob -->
    <script src="{{asset('js/jquery.knob.min.js')}}"></script>
    <!-- Switchery -->
    <script src="{{asset('js/switchery.min.js')}}"></script>
    <script>
        $("#fecha_nula").click(function(e){
          if($("#single_cal4").prop("disabled")==false){
            $("#single_cal4").attr("disabled","true");
          }
          else{
            $("#single_cal4").removeAttr("disabled");
          }
        });
    </script>
    <script>
  var entrada=document.getElementById('listaaa');
  var salida=document.getElementById('edwinsito');

  entrada.addEventListener('change',function(){
  var valorIdEnviar = document.querySelector("#datalistOptions option[value='"+entrada.value+"']").dataset.value;
  salida.value=valorIdEnviar;
  });
</script>
@endsection