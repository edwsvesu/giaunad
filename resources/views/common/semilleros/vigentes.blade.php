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
                <h2>Semilleros</h2>
                <div class="clearfix"></div>
            </div>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
        <th>Nombre</th>
        <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($semilleros as $semillero)
        <tr>
        <td>{{$semillero->nombre}}</td> 
        <td>
            <a href="/semilleros/semillero/{{$semillero->codigo}}" class="btn btn-info btn-xs view-info-form"><i class="fa fa-eye"></i> Ir</a>
            @if($privilegio=="admin" || $privilegio=="codirector")
                <a href="/semilleros/semillero/{{$semillero->codigo}}/editar" class="btn btn-dark btn-xs view-info-form"><i class="fa fa-edit"></i> Editar</a>
            @endif
            @if($privilegio=="admin")
                <button class="btn btn-danger btn-xs btn-del-semillero" value="{{$semillero->codigo}}" data-toggle="modal" data-target="#modal-del-semillero"><i class="fa fa-trash"></i> Eliminar</button>
            @endif
        </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
</div>
</div>

<div id="modal-del-semillero" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
  
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Eliminar semillero</h4>
        </div>
        <div class="modal-body">
          <h4>¿Está seguro que desea eliminar el semillero seleccionado?</h4>
          <p>Si continua con esta acción se eliminará permanentemente, pulse <strong>ACEPTAR</strong> para continuar.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
          <button id="btn-elim-semillero" type="button" class="btn btn-danger" data-dismiss="modal">ACEPTAR</button>
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
    var elementoSeleccionado;
    $(".btn-del-semillero").click(function() {
      elementoSeleccionado=$(this);
    });
    $("#btn-elim-semillero").click(function(){
        eliminarSemillero(elementoSeleccionado);
    });
     function eliminarSemillero(elemento){
       $.ajax({
           url:'/semilleros/semillero/'+$(elemento).val(),
           method:'DELETE',
           beforeSend:function(){
               ActivarEfectoCargaPagina();
           },
           complete:function(){
               DesactivarEfectoCargaPagina();
           },
           success: function(data){
               if(data!=0){
                 $('#datatable').DataTable().row($(elemento).closest("tr").get(0)).remove().draw();
                 mensajeExito("Se ha eliminado correctamente");
               }
               else{
                   mensajeError("No se pudo eliminar el semillero");
               }
           },
           error:function(){
               mensajeError("Ha ocurrido un error, la acción no se ha realizado");
           }
       });
     }
  </script>
@endsection