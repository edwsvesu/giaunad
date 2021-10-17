@section('estilos')
<link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<style>
    .activity-details{
        width: 100%;
        padding-right: 30px;
    }

    .activity-details .info{
        font-size: 15px;
        border-bottom: 1px dashed;
        margin-bottom: 10px;
        padding-bottom: 15px;
    }

    .activity-details .file{
        display: flex;
        align-items: center;
        padding: 8px;
    }

    .activity-details .file a{
        margin-right: 10px;
    }

    .activity-details .file .remove{
        font-size: 17px;
        cursor: pointer;
    }

    .activity-deliveries .header{
        text-align: center;
        margin-bottom: 5vh;
    }

    .section-activity-deliveries{
        display: flex;
        flex-wrap: wrap;
    }

    .activity-deliveries{
        width: 40%;
    }

    .activity-deliveries-container{
        box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -webkit-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -moz-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -ms-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        border-radius: 0.5rem;
        padding: 15px;
    }

    .dataTables_filter{
        width: auto !important;
    }

    .activity-files{
        font-size: 15px;
        margin-top: 40px;
    }

    .activity-files h4{
        font-size: 15px;
        padding: 0;
        margin: 0;
        font-weight: bold;
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
                <!--comienzo seccion de detalle de la actividad -->
                <div class="activity-details">
                    <!--comienzo info general -->
                    <div class="info">
                        @isset($infoActividad[0]->fecha_entrega)
                            <div><strong>Fecha de entrega:</strong> {{$infoActividad[0]->fecha_entrega}}</div>   
                        @endisset
                    </div>
                    <!--fin info general-->

                    <!--comienzo instrucciones y soporte-->
                    <div>
                        @isset($infoActividad[0]->instrucciones)
                            <p>{{$infoActividad[0]->instrucciones}}</p>
                        @endisset
                        <!--<div class="activity-files">
                            <h4>Archivos adjuntos</h4>
                            <div class="file">
                                <a href=""><i class="fa fa-file-word-o"></i> Functional-requirements.docx</a>
                            
                                    <span class="fa fa-remove remove"></span>
                  
                            </div>

                            <div class="file">
                                <a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
                           
                                    <span class="fa fa-remove remove"></span>
                            
                            </div>

                            <div class="file">
                                <a href=""><i class="fa fa-picture-o"></i> Logo.png</a>
                           
                                    <span class="fa fa-remove remove"></span>
                                
                            </div>

                        </div>-->
                    </div>
                    <!--fin instrucciones y soporte-->

                </div>
                <!--fin seccion de detalle de la actividad -->

                <!-- inicio seccion de entregas de la actividad-->
                <!--<div class="activity-deliveries">
                   <div class="activity-deliveries-container"> 
                    <div class="header">
                        <h2>Entregas</h2>    
                    </div>

                    <div class="table">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Accion</th>
                        
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                         
                                </tr>
                                <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                            
                                </tr>
                                <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                          
                                </tr>
                                <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                            
                                </tr>
                                <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
      
                                </tr>

                                                            <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                         
                                </tr>
                                <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                            
                                </tr>
                                <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                          
                                </tr>
                                <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                            
                                </tr>
                                <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
      
                                </tr>

                                                            <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                         
                                </tr>
                                <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                            
                                </tr>
                                <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                          
                                </tr>
                                <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                            
                                </tr>
                                <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
      
                                </tr>

                                                            <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                         
                                </tr>
                                <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                            
                                </tr>
                                <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                          
                                </tr>
                                <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                            
                                </tr>
                                <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
      
                                </tr>

                                                            <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                         
                                </tr>
                                <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                            
                                </tr>
                                <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                          
                                </tr>
                                <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                            
                                </tr>
                                <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
      
                                </tr>

                                </tr>
                                <tr>
                                <td>Edwin Velandia</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
      
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>-->
                <!-- fin de seccion de entregas de la actividad-->
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
     $('#datatable').dataTable({
    "bPaginate": false, //hide pagination
    "bInfo": false, // hide showing entries
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados"
        }
});
 </script>
@endsection