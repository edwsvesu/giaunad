@section('estilos')
    <link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('contenido')
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
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-folder"></i> Mis proyectos</h2>
                <div class="clearfix"></div>
            </div>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
        <th>Tipo de proyecto</th>
        <th>Título</th>
        <th>Código</th>
        <th>Estado</th>
        <th>Fecha inicio</th>
        <th>Fecha fin</th>
        <th>Lider</th>
        <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($proyectos as $proyecto)
        <tr>
        <td>{{$proyecto->tipo}}</td> 
        <td>{{$proyecto->titulo}}</td>
        <td>{{$proyecto->codigo}}</td>
        <td>{{$proyecto->estado}}</td>
        <td>{{$proyecto->fecha_inicio}}</td>
        <td>{{$proyecto->fecha_fin}}</td>
        <td>{{$proyecto->lider}}</td>
        <td>
            <a href="/proyectos/proyecto/{{$proyecto->codigo}}" class="btn btn-info btn-xs view-info-form"><i class="fa fa-eye"></i> Ir</a>
            @if($privilegio=="admin" || $privilegio=="codirector")
                <a href="/proyectos/proyecto/{{$proyecto->codigo}}/editar" class="btn btn-dark btn-xs view-info-form"><i class="fa fa-edit"></i> Editar</a>
            @endif
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
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
@endsection