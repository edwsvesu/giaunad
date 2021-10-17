@section('contenido')
<div class="clearfix"></div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Crear nuevo semillero</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br/>
                    <form action="/semilleros/nuevo" enctype="multipart/form-data" method="post" data-parsley-validate class="form-horizontal form-label-left">
                      @csrf
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="nombre" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Coordinador</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="coordinador" class="form-control col-md-7 col-xs-12" list="datalistOptions" type="text" autocomplete="off">
                          <input id="coordinador_id" type="hidden" name="coordinador_id">
                          <datalist id="datalistOptions">
                            @foreach ($coordinadores as $coordinador)
                              <option data-value="{{$coordinador->id}}" value="{{$coordinador->usuario}}"></option>
                            @endforeach                             
                          </datalist>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="lider" class="control-label col-md-3 col-sm-3 col-xs-12">Lider</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="lider" class="form-control col-md-7 col-xs-12" list="datalistOptions2" type="text" autocomplete="off">
                          <input id="lider_id" type="hidden" name="lider_id">
                          <datalist id="datalistOptions2">
                            @foreach ($lideres as $lider)
                              <option data-value="{{$lider->id}}" value="{{$lider->usuario}}"></option>
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

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
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
      $("#coordinador").change(function(){
        $("#coordinador_id").val($("#datalistOptions option[value='"+$(this).val()+"']").data('value'));
      });
      $("#lider").change(function(){
        $("#lider_id").val($("#datalistOptions2 option[value='"+$(this).val()+"']").data('value'));
      });
    </script>
@endsection