@extends('administrador.dashboard')
@section('estilos')
<link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<style>
    .activity-details{
        width: 60%;
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
                <h2><i class="fa fa-book"></i> Nombre de la actividad</h2>
                <div class="clearfix"></div>
            </div>
            <div class="section-activity-deliveries">
                <!--comienzo seccion de detalle de la actividad -->
                <div class="activity-details">
                    <!--comienzo info general -->
                    <div class="info">
                        <div>Fecha de entrega: 8 agosto.</div>
                    </div>
                    <!--fin info general-->

                    <!--comienzo instrucciones y soporte-->
                    <div>
                        <p>frfrf  tgiotogijgijtgoit jgoi go jgjg oitgoit goitjgoitjgt gjtog jtrig trigjtrogj tijtoigjtriogj trigjtrog trgj trig triog toigjtrgjtoigjtrio gtr gtr goit jgt gjotr jgot jgoitrj goitj gotrj  got jgtrj t gjt jojijtgotjg jj o jjg   tgktg jtg jtgjtrl gjtlr gjlktrjg ltg j jglt ltk jgltr jglt jgt  gtgtgjt g gtrg rtjgltjgtgt gt jgtr gltr jgltrjgtr gtr glktrjgltrjgjtrgl tr</p>
                        <div class="activity-files">
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

                        </div>
                    </div>
                    <!--fin instrucciones y soporte-->

                </div>
                <!--fin seccion de detalle de la actividad -->

                <!-- inicio seccion de entregas de la actividad-->
                <div class="activity-deliveries">
                   <div class="activity-deliveries-container"> 
                    <div class="header">
                        <h2>Tu trabajo</h2>
                        <button type="button" class="btn btn-default">+ Añadir</button>
                        <button type="button" class="btn btn-dark">Entregar</button>   
                    </div>

                    <div class="files-upload">
                        <div class="file">
                            
                        </div>
                    </div>
                </div>
                </div>
                <!-- fin de seccion de entregas de la actividad-->
            </div>
		</div>
	</div>
</div>
@endsection