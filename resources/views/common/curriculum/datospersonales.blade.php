@section('contenido')
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-book"></i> Nombre de la actividad</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="{{isset($datos[0]->foto) ? asset('storage/'.$datos[0]->foto):asset('images/user.png')}}" alt="Avatar">
                        </div>
                      </div>
                      <h3>{{$datos[0]->nombres." ".$datos[0]->apellidos}}</h3>


                      <a href="/curriculum/datos-generales/datos-personales/editar"  class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Editar información</a>
                      <br />


                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Información de indentificación</h2>
                        </div>
                      </div>
                      <br>
                      <ul>
                      	<li><span><strong>Documento de identificación:</strong> {{$datos[0]->numero_documento}}</span></li>
                      	<li><span><strong>Nombres:</strong> {{$datos[0]->nombres}}</span></li>
                      	<li><span><strong>Apellidos:</strong> {{$datos[0]->apellidos}}</span></li>
                      </ul>
                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Información de contacto</h2>
                        </div>
                      </div>
                      <br>
                      <ul>
                      	<li><span><strong>Correo electrónico principal:</strong> {{$datos[0]->correo_principal}}</span></li>
                      	<li><span><strong>correo electrónico secundario:</strong> {{$datos[0]->correo_secundario}}</span></li>
                      	<li>
                      		<span><strong>Telefonos:</strong></span>
                      		<ul>
                            @foreach($datos['telefonos'] as $telefono)
                              <li><span><strong>{{$telefono->descripcion}}:</strong> {{$telefono->numero}}</span></li>
                            @endforeach
                      		</ul>
                      	</li>
                      </ul>
                    </div>
                </div>

		</div>
	</div>
</div>
@endsection	