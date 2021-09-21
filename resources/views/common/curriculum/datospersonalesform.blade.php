@section('estilos')
<style>
  li{
    margin-bottom: 15px;
  }
</style>
@endsection
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
              <form method="post" action="/curriculum/datos-generales/datos-personales/editar" enctype="multipart/form-data">
                @csrf
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img id="user-image" class="img-responsive avatar-view" src="{{isset($datos[0]->foto) ? asset('storage/'.$datos[0]->foto):asset('images/user.png')}}" alt="Avatar">
                        </div>
                      </div>
                      <br>
                      <input id="load-image" style="display: none;" type="file" name="foto">
                      <button id="btn-add-image" type="button" class="btn btn-dark"> <i class="fa fa-photo m-right-xs"> </i> Cambiar imagen</button>
                      <br>
                      <button id="btn-send-form" type="submit" class="btn btn-primary"> <i class="fa fa-edit m-right-xs"> </i> Guardar cambios</button>
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
                      	<li><span><strong>Documento de identificación:</strong> {{$datos[0]->numero_documento}} </span></li>
                      	<li><span><strong>Nombres:</strong> <input type="text" name="nombres" value="{{$datos[0]->nombres}}"></span></li>
                      	<li><span><strong>Apellidos:</strong> <input type="text" name="apellidos" value="{{$datos[0]->apellidos}}"></span></li>
                      </ul>
                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>Información de contacto</h2>
                        </div>
                      </div>
                      <br>
                      <ul>
                      	<li><span><strong>Correo electrónico principal:</strong> <input type="text" name="correo_principal" value="{{$datos[0]->correo_principal}}"></span></li>
                      	<li><span><strong>correo electrónico secundario:</strong> <input type="text" name="correo_secundario" value="{{$datos[0]->correo_secundario}}"></span></li>
                      	<li>
                      		<span><strong>Telefonos:</strong></span>
                      		<ul id="lista-telefonos">
                            @foreach($datos['telefonos'] as $telefono)
                              <li> <input type="hidden" name="telefonos[][id]" value="{{$telefono->id}}"> <span><strong>Descripción: </strong><input name="telefonos[][descripcion]" type="text" value="{{$telefono->descripcion}}"> <strong>Número: </strong> <input name="telefonos[][numero]" type="text" value="{{$telefono->numero}}"></span> <button type="button" value="{{$telefono->id}}" class="btn-del-tel btn btn-danger"><i class="fa fa-trash"></i></button></li>
                            @endforeach
                            <li><input id="in-usu-tel" value="{{$datos[0]->id}}" type="hidden"> <strong>Agregar nuevo:</strong> <span>Descripción:<input id="in-des-tel" type="text">Número: <input id="in-num-tel" type="text"></span> <button type="button" id="agregar-telefono" class="btn btn-primary"><i class="fa fa-plus"></i></button></li>
                      		</ul>
                      	</li>
                      </ul>
                    </div>
                  </form>
                </div>

		</div>
	</div>
</div>
@endsection
@section('javascript')
<script>
  $("#btn-add-image").click(function(){
        $("#load-image").focus().trigger("click");
  });

  $("#load-image").change(function () {
    filePreview(this);
  });

function filePreview(input) {
   if (input.files && input.files[0]) {
     let reader = new FileReader();
     reader.readAsDataURL(input.files[0]);
     reader.onload = function (e) {
     $('#user-image').replaceWith("<img id='user-image' class='img-responsive avatar-view' src='"+e.target.result+"' alt='Avatar'>");
     }
   }
}


  $(".btn-del-tel").click(function(){
    eliminarTelefono($(this).val(),$(this));
  });

  $("#agregar-telefono").click(function(){
    agregarTelefono($("#in-des-tel").val(),$("#in-num-tel").val(),$("#in-usu-tel").val(),$(this));
    $("#in-des-tel").val('');
    $("#in-num-tel").val('');
  });  

  function agregarTelefono(descripcion,numero,usuario_id,elemento){
    $.ajax({
    url:'/curriculum/datos-generales/datos-personales/editar/telefono',
    data: {
      descripcion:descripcion,
      numero:numero,
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
        if(data){
          elemento.parent().before("<li> <input type='hidden' name='telefonos[][id]' value='"+data+"'> <span><strong>Descripción: </strong><input name='telefonos[][descripcion]' type='text' value='"+descripcion+"'> <strong>Número: </strong> <input name='telefonos[][numero]' type='text' value='"+numero+"'></span> <button type='button' value='"+data+"' class='btn-del-tel btn btn-danger'><i class='fa fa-trash'></i></button></li>");
          $(".btn-del-tel").click(function(){
            eliminarTelefono($(this).val(),$(this));
          });
        }
        else{
            mensajeError("El Teléfono no se pudo borrar");
        }
    },
    error:function(){
        mensajeError("Ha ocurrido un error, la acción no se ha realizado");
    }
    });
  }

function eliminarTelefono(telefono_id,elemento){
    $.ajax({
    url:'/curriculum/datos-generales/datos-personales/editar/telefono',
    data: {
      telefono_id:telefono_id
    },
    method:'DELETE',
    beforeSend:function(){
        ActivarEfectoCargaPagina();
    },
    complete:function(){
        DesactivarEfectoCargaPagina();
    },
    success: function(data){
        if(data=1){
          $(elemento).parent().remove();
        }
        else{
            mensajeError("El Teléfono no se pudo borrar");
        }
    },
    error:function(){
        mensajeError("Ha ocurrido un error, la acción no se ha realizado");
    }
  });
}
</script>
@endsection