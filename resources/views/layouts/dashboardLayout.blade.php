<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Giaunad</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
<!-- NProgress -->
<link href="{{asset('css/nprogress.css')}}" rel="stylesheet">
    @yield('estilos')
    <!--PNotify--> 
<link href="{{asset('css/pnotify.css')}}" rel="stylesheet">
<link href="{{asset('css/pnotify.buttons.css')}}" rel="stylesheet">
<link href="{{asset('css/pnotify.nonblock.css')}}" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="{{asset('css/jquery.mCustomScrollbar.min.css')}}" rel="stylesheet"/>
    <!-- Custom Theme Style -->
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">
  </head>
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <body class="nav-md">
    <div id="cargadorDePaginaPrincipal" class="cargaPagina"><div><img src="{{asset('images/loader.gif')}}"></div></div>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"></i><i class="fa fa-home"></i> <span>Giaunad</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{isset(Auth::user()->foto) ? asset('storage/'.Auth::user()->foto):asset('images/user.png')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>@yield('rol')</span>
                <h2>{{Auth::user()->nombres}} {{Auth::user()->apellidos}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  <li><a href="/home"><i class="fa fa-laptop"></i> Inicio</a></li>
                    @yield('menuLateral')
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{isset(Auth::user()->foto) ? asset('storage/'.Auth::user()->foto):asset('images/user.png')}}" alt="">{{Auth::user()->nombres}} {{Auth::user()->apellidos}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="/perfil/cambiar-contrasena">Cambiar contraseña</a></li>
                  
                    <li>
                      <form id="form_out" method="POST" action="/salir">
                        @csrf
                      </form>
                      <a id="link_out" href="/salir"><i class="fa fa-sign-out pull-right"></i>Salir</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('contenido')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <!--<div class="pull-right">
            Pie de página <a href="#">Enlace</a>
          </div>
          <div class="clearfix"></div>-->
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <!-- Bootstrap -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('js/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('js/nprogress.js')}}"></script>
         <!-- PNotify -->
<script src="{{asset('js/pnotify.js')}}"></script>
<script src="{{asset('js/pnotify.buttons.js')}}"></script>
<script src="{{asset('js/pnotify.nonblock.js')}}"></script>
    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $("#link_out").click(function(e){
          e.preventDefault();
          $("#form_out").submit()
        });
    </script>
    @yield('javascript')

    <!-- jQuery custom content scroller -->
    <script src="{{asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <!-- Parsley -->
    <script src="{{asset('js/parsley.min.js')}}"></script>
    <script src="{{asset('js/i18n/es.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{asset('js/custom.min.js')}}"></script>
  </body>
</html>