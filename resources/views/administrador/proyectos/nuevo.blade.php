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
                    <h2>Crear nuevo proyecto</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="/proyectos/nuevo/crear" enctype="multipart/form-data" method="post" data-parsley-validate class="form-horizontal form-label-left">
                      @csrf
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Código <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input name="codigo" type="text" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Título <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="titulo" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de proyecto</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="tipo_proyecto_id" class="form-control">
                              <option selected value="">Seleccione un tipo</option>
                            @foreach($tipos_proyectos as $tipo)
                              <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="lider" class="control-label col-md-3 col-sm-3 col-xs-12">Lider</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="lidera" class="form-control col-md-7 col-xs-12" list="datalistOptions" type="text" autocomplete="off">
                          <input id="lidera_id" type="hidden" name="lidera">
                          <datalist id="datalistOptions">
                            @foreach($usuarioslideres as $usuariolider)
                              <option data-value="{{$usuariolider->id}}" value="{{$usuariolider->usuario}}"></option>
                            @endforeach
                          </datalist>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="fecha_inicio" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha inicio</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">      
                          <input name="fecha_inicio" type="date" class="form-control col-md-7 col-xs-12" placeholder="fecha de inicio">
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="fecha_fin" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha fin</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">      
                          <input name="fecha_fin" type="date" class="form-control col-md-7 col-xs-12" placeholder="Fecha fin">
                        </div>
                      </div>                      

                      <!--<div class="form-group">
                        <label for="fecha_inicio" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha inicio</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">      
                          <input name="fecha_inicio" type="date" class="form-control has-feedback-left col-md-7 col-xs-12" id="single_cal1" placeholder="First Name">
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
                      </div>-->

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Documentacion <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input name="documento[]" type="file" multiple>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="reset" class="btn btn-danger">Borrar</button>
                          <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
@endsection
@section('javascript')
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
        $("#fecha_nula").click(function(e){
          if($("#single_cal4").prop("disabled")==false){
            $("#single_cal4").attr("disabled","true");
          }
          else{
            $("#single_cal4").removeAttr("disabled");
          }
        });
    </script>
@endsection
