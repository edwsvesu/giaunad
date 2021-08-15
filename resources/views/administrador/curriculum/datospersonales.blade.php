@extends('administrador.dashboard')
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
                          <img class="img-responsive avatar-view" src="{{asset('images/user.png')}}" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3>Abiel Jose Eliseo Mendoza Gutirerez</h3>


                      <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Editar información</a>
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
                      	<li><span><strong>Documento de identificación:</strong> 4343432434</span></li>
                      	<li><span><strong>Nombres:</strong> fjdfk jfldkfd</span></li>
                      	<li><span><strong>Apellidos:</strong> fdfdf fdfdf</span></li>
                      </ul>
                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Información de contacto</h2>
                        </div>
                      </div>
                      <br>
                      <ul>
                      	<li><span><strong>Correo electrónico principal:</strong> gttgt@ffrfr.com</span></li>
                      	<li><span><strong>correo electrónico secundario:</strong> derf@ddrfr.com</span></li>
                      	<li>
                      		<span><strong>Telefonos:</strong></span>
                      		<ul>
                      			<li><span><strong>principal:</strong> 545454</span></li>
                      			<li><span><strong>casa:</strong> 434334</span></li>
                      			<li><span><strong>trabajo:</strong> 45454</span></li>
                      		</ul>
                      	</li>
                      </ul>
                    </div>
                </div>

		</div>
	</div>
</div>
@endsection		