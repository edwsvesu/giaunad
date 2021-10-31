@section('estilos')
<style>
    .file a[href] .fa::before{
        content: "\f15b";
    }

    .file a[href$=".pdf"] .fa::before{
        content: "\f1c1";
    }

    .file a[href$=".docx"] .fa::before{
        content: "\f1c2";
    }

    .file a[href$=".png"] .fa::before{
        content: "\f03e";
    }

    .file a[href$=".jpg"] .fa::before{
        content: "\f03e";
    }

    .user{
        display: flex;
        align-items: center;
    }

    .user_pic{
        margin-right: 25px;
    }

    .user_pic img{
        width: 90px;
        height: 90px;
    }

    .name{
        font-size: 1.3em;
        font-weight: bold;
    }

    .delivery-files{
        box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -webkit-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -moz-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -ms-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        border-radius: 0.5rem;
        padding: 25px;
        margin-bottom: 20px;    
    }

    .delivery-files .sub-two{
        text-align: center;
    }

    .sub-two{
        font-size: 1.4em;
        margin: 0 0 10px 0;
    }

    .sub-one{
        font-size: 1.7em;
        margin: 0 0 10px 0;
    }

    .section-actions-header{
        margin-bottom: 25px;
    }
</style>
@endsection
@section('contenido')
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-book"></i> Titulo</h2>
                <div class="clearfix"></div>
            </div>
            <div class="section-actions-header">
                <div class="section-users">
                    <div class="user">
                        <div class="user_pic">
                            <img src="{{isset($autor->foto) ? asset('storage/'.$autor->foto):asset('images/user.png')}}" alt="...">
                        </div>
                        <div class="user_info">
                            <div class="name">
                                <span>{{$autor->nombres." ".$autor->apellidos}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main">
                <div class="delivery-section">
                    <div class="delivery">
                        <h2 class="sub-one">Entrega de la actividad</h2>
                        <div class="delivery-files">
                            <h3 class="sub-two">Archivos</h3>
                            <div>
                                <ul class="list-group">
                                    @if ($archivosEntrega)
                                        @foreach ($archivosEntrega as $archivo)
                                        <li class="list-group-item">
                                            <div class="file">
                                                <a href="{{Request::url()."/archivo/".$archivo->ruta}}"><i class="fa"></i> {{$archivo->nombre}}</a>
                                            </div>
                                        </li>
                                        @endforeach
                                    @else
                                        <li  class="list-group-item">
                                            No se han adjuntado archivos
                                        </li>
                                        
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
@section('javascript')
@endsection