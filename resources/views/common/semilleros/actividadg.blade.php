@section('estilos')
<link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<style>
    .info-item{
        font-size: 1.1em;
    }

    .sub-two{
        font-size: 1.4em;
        margin: 0 0 10px 0;
    }

    .sub-one{
        font-size: 1.7em;
        margin: 0 0 10px 0;
    }

    .support-files{
        padding: 10px;
        margin-bottom: 10px;
    }

    .support-files .file{
        margin: 0 0 10px 2%;
    }

    .support-files .file a{
        margin-right: 10px;
        text-transform: uppercase;
    }

    .information{
        border-bottom: 1px solid #E6E9ED;
        padding: 10px;
        margin-bottom: 15px;
    }

    .deliveries-list{
        box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -webkit-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -moz-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -ms-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        border-radius: 0.5rem;
        padding: 25px;
        margin-bottom: 20px;
    }

    .deliveries-list .sub-one{
        text-align: center;
    }

    .support-files .file .remove{
        cursor: pointer;
        font-size: 1.5em;
    }

    .instructions{
        padding: 10px;
        margin-bottom: 10px;
    }

    .instructions p{
        margin: 0;
    }
</style>
@endsection
@section('contenido')
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-book"></i> {{$infoActividad[0]->titulo}}</h2>
                <div class="clearfix"></div>
            </div>
            <div class="section-activity-deliveries">
                <div class="activity-details">
                    <div class="information">
                        <div class="info-item"><strong>Fecha de entrega: </strong>{{$infoActividad[0]->fecha_entrega ? $infoActividad[0]->fecha_entrega:"No especificada"}}</div>
                    </div>
                    @if($infoActividad[0]->instrucciones)
                        <div class="instructions">
                            <h3 class="sub-two">Instrucciones</h3>
                            <p>{{$infoActividad[0]->instrucciones}}</p>
                        </div>
                    @endif
                    <!-- aun no se ha implementado -->
                    <!--<div class="support-files">
                        <h3 class="sub-two">Archivos adjuntos</h3>
                        <div class="file">
                            <a href="UAT.pdf"><i class="fa"></i> UAT.pdf</a>
                            <span class="fa fa-remove remove"></span>
                        </div>
                        <div class="file">
                            <a href="foto.jpg"><i class="fa"></i> foto.jpg</a>
                            <span class="fa fa-remove remove"></span>
                        </div>
                        <div class="file">
                            <a href="raro.raro"><i class="fa"></i> raro.raro</a>
                            <span class="fa fa-remove remove"></span>
                        </div>
                        <div class="file">
                            <a href="Logo.png"><i class="fa"></i> Logo.png</a>
                            <span class="fa fa-remove remove"></span>
                        </div>
                        <div class="file">
                            <a href="Functional-requirements.docx"><i class="fa"></i> Functional-requirements.docx</a>
                            <span class="fa fa-remove remove"></span>
                        </div>
                    </div>-->
                </div>

                <div class="deliveries">
                    <div class="deliveries-list">
                        <h2 class="sub-one">Entregas</h2>
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach ($entregas as $entrega)
                                    <tr>
                                        <td>{{$entrega->usuario}}</td>
                                        <td><a href="{{Request::url()."/entrega/".$entrega->codigo}}" class="btn btn-primary btn-xs view-info-form"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
@section('javascript')
 <!-- Datatables -->
 <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
 <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
 <script src="{{asset('js/buttons.bootstrap.min.js')}}"></script>
 <script src="{{asset('js/buttons.flash.min.js')}}"></script>
 <script src="{{asset('js/buttons.html5.min.js')}}"></script>
 <script src="{{asset('js/buttons.print.min.js')}}"></script>
 <script src="{{asset('js/dataTables.fixedHeader.min.js')}}"></script>
 <script src="{{asset('js/dataTables.keyTable.min.js')}}"></script>
 <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
 <script src="{{asset('js/responsive.bootstrap.js')}}"></script>
 <script src="{{asset('js/dataTables.scroller.min.js')}}"></script>
  <script>
$(document).ready(function(){
    var table = $('#datatable').DataTable({
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });
});
 </script>
@endsection