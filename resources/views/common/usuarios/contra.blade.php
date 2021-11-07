@section('estilos')
<!-- bootstrap-daterangepicker -->
<link href="{{asset('css/daterangepicker.css')}}" rel="stylesheet">
<!-- Switchery -->
<link href="{{asset('css/switchery.min.css')}}" rel="stylesheet">
<link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
<div class="clearfix"></div>
<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cambiar contraseña</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="form-proyecto" action=""  method="post" data-parsley-validate class="form-horizontal form-label-left">
                      @csrf
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contraseña <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input name="anterior" type="password" class="form-control col-md-7 col-xs-12" required="required"  maxlength="50">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nueva contraseña <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input name="nueva"  id="pass" type="password" class="form-control col-md-7 col-xs-12" required="required"  maxlength="50">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Confirmar contraseña <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="password" class="form-control col-md-7 col-xs-12" required="required"  maxlength="50" data-parsley-equalto="#pass">
                        </div>
                      </div>
                

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button id="btn-cancel" type="reset" class="btn btn-default">Cancelar</button>
                          <button type="submit" class="btn btn-primary">Cambiar</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
@endsection
@section('javascript')
@endsection