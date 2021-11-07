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
                <h2><i class="fa fa-folder"></i> Proyectos vigentes</h2>
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
            <a href="/proyectos/proyecto/{{$proyecto->codigo}}/editar" class="btn btn-dark btn-xs view-info-form"><i class="fa fa-edit"></i> Editar</a>
            @if($privilegio=="admin")
                <button class="btn btn-danger btn-xs btn-del-proyecto" value="{{$proyecto->codigo}}" data-toggle="modal" data-target="#modal-del-proyecto"><i class="fa fa-trash"></i> Eliminar</button>
            @endif
            @if($privilegio=="admin")
               <button class="btn btn-warning btn-xs btn-close" value="{{$proyecto->codigo}}"><i class="fa fa-remove"></i> Cerrar</button>
            @endif
        </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
</div>
</div>

<div id="modal-del-proyecto" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
  
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Eliminar proyecto</h4>
        </div>
        <div class="modal-body">
          <h4>¿Está seguro que desea eliminar el proyecto seleccionado?</h4>
          <p>Si continua con esta acción se eliminará permanentemente, pulse <strong>ACEPTAR</strong> para continuar.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
          <button id="btn-elim-proyecto" type="button" class="btn btn-danger" data-dismiss="modal">ACEPTAR</button>
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
    $(".btn-del-proyecto").click(function() {
      elementoSeleccionado=$(this);
    });
    $("#btn-elim-proyecto").click(function(){
        eliminarProyecto(elementoSeleccionado);
    });
     function eliminarProyecto(elemento){
       $.ajax({
           url:'/proyectos/proyecto/'+$(elemento).val(),
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
                   mensajeError("No se pudo eliminar el proyecto");
               }
           },
           error:function(){
               mensajeError("Ha ocurrido un error, la acción no se ha realizado");
           }
       });
     }

     $(".btn-close").click(function(){
       cerrar($(this));
     });
     function cerrar(elemento){
       $.ajax({
           url:'/proyectos/proyecto/'+$(elemento).val()+'/cerrar',
           method:'POST',
           beforeSend:function(){
               ActivarEfectoCargaPagina();
           },
           complete:function(){
               DesactivarEfectoCargaPagina();
           },
           success: function(data){
               if(data!=0){
                 $('#datatable').DataTable().row($(elemento).closest("tr").get(0)).remove().draw();
               }
               else{
                   mensajeError("No se pudo cerrar");
               }
           },
           error:function(){
               mensajeError("Ha ocurrido un error, la acción no se ha realizado");
           }
       });
     }
  </script>
@endsection
