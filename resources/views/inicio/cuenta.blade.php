@extends("layouts.inicioLayout")
@section("estilos")
<style>
.login_incorrect{
  border: 2px solid red;
  margin-bottom: 1vw;
  padding: 15px;
  background-color: rgb(255,230,230);
  color: red;
  font-weight: bold;
  text-shadow: none;
}
</style>
@endsection
@section('contenido')
@if(session('true'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Usuario registrado con éxito! </strong>{{session('true')}}.
        </div>
@elseif(session('false'))
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Usuario no registrado: </strong>{{session('false')}}.
        </div>
@endif

    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post">
              @csrf
              <h1>Iniciar sesión</h1>
              @if(session('user_incorrect'))
                <div class="login_incorrect">{{session('user_incorrect')}}</div>
              @endif
              @if ($errors->any())
                <div class="login_incorrect">
                    @foreach ($errors->all() as $error)
                      {{ $error }}
                    @endforeach
                </div>
              @endif
              <div>
                <input type="text" name="numero_documento" class="form-control" placeholder="Usuario"/>
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Contraseña"/>
              </div>
              <div>
                <button type="submit" class="btn btn-default submit">Iniciar sesión</button>
                <a class="reset_pass" href="#">¿perdiste tu contraseña?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">¿Eres nuevo?
                  <a href="#signup" class="to_register">Crea una cuenta</a>
                </p>

                <div class="clearfix"></div>
                <br />

                <!--<div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>-->
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="post" action="/registrarse">
              @csrf
              <h1>Crear cuenta</h1>
              <div>
                  <input name="numero_documento" type="text" class="form-control" placeholder="Documento" required="required"/>
              </div>
              <div>
                <input name="nombres" type="text" class="form-control" placeholder="Nombres" required="required" />
              </div>
             <div>
                <input name="apellidos" type="text" class="form-control" placeholder="Apellidos" required="required" />
              </div>
              <div>
                <input name="correo_principal" type="email" class="form-control" placeholder="Correo electrónico principal" required="required" />
              </div>
              <div>
                <input name="correo_secundario" type="email" class="form-control" placeholder="Correo electrónico secundario" required="" />
              </div>
              <div>
                <input name="clave" type="password" class="form-control" placeholder="Contraseña" required="required" />
              </div>

              <div>
                <input type="password" class="form-control" placeholder="Confirmar contraseña" required="required" />
              </div>
              <div>
                <button type="submit" class="btn btn-dark">Enviar</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">¿Ya tienes una cuenta?
                  <a href="#signin" class="to_register">Iniciar sesión</a>
                </p>

                <div class="clearfix"></div>
                <br />

                <!--<div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>-->
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
@endsection
