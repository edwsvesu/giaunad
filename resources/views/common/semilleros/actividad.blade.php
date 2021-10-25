@section('estilos')
<link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
<style>
    .section-activity-deliveries a[href] .fa::before{
        content: "\f15b";
    }

    .section-activity-deliveries a[href$=".pdf"] .fa::before{
        content: "\f1c1";
    }

    .section-activity-deliveries a[href$=".docx"] .fa::before{
        content: "\f1c2";
    }

    .section-activity-deliveries a[href$=".png"] .fa::before{
        content: "\f03e";
    }

    .section-activity-deliveries a[href$=".jpg"] .fa::before{
        content: "\f03e";
    }

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

    .delivery-space{
        box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -webkit-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -moz-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -ms-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        border-radius: 0.5rem;
        padding: 25px;
        margin-bottom: 20px;
    }

    .delivery-space .sub-one{
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
    
    #form-upload{
        display: none;
    }

    .work-files .list-group-item{
        display: flex;
        align-items: center;
    }

    .work-files .upload .file{
        margin-right: 10px;
    }

    .work-files .progress{
        flex: auto;
        margin-bottom: 0;
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
                        <!--<div class="info-item"><strong>Tema: </strong> tema de la actividad.</div>-->
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
                <div class="workspace">
                    <div class="delivery-space">
                        <h2 class="sub-one">Realización de la actividad</h2>
                        <form id="form-upload">
                            <input id="input-upload" type="file" multiple>
                        </form>
                        <div class="actions">
                            <a id="btn-add" class="btn btn-app">
                                <i class="fa fa-paperclip"></i> Añadir
                            </a>
                            <a id="btn-upload" style="display: none;" class="btn btn-app">
                                <span class="badge bg-blue"></span>
                                <i class="fa fa-upload"></i> Subir
                            </a>
                            <a id="btn-cancel" style="display: none;" class="btn btn-app">
                                <i class="fa fa-times-circle"></i> Cancelar
                            </a>
                            <a class="btn btn-app">
                                <i class="fa fa-save"></i> Entregar
                            </a>
                            
                        </div>
                        <!-- work-products es general, se refiere a cualquier tipo de productos del trabajo, puede ser entrega de archivos (work-files) entre otros como preguntas simplemente... -->
                        <div class="work-products">

                            <div class="work-files">
                                <ul class="list-group">
                                    <!--<li class="list-group-item upload">
                                        <div class="file">
                                            <a href="Functional-requirements.docx"><i class="fa"></i> Functional-requirements.docx</a>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar  progress-bar-danger" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
                                            
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div>
                                            <a href="UAT.pdf"><i class="fa"></i> UAT.pdf</a>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div>
                                            <a href="Logo.png"><i class="fa"></i> Logo.png</a>
                                        </div>
                                    </li>-->
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
    <script src="{{asset('js/bootstrap-progressbar.min.js')}}"></script>
    <script>
        $("#btn-add").click(function(){
            $("#input-upload").focus().trigger("click");
        });

        $("#input-upload").change(function(){
            if(this.files.length>0){
                $("#btn-upload").show();
                $("#btn-upload .badge").text(this.files.length);
                $("#btn-cancel").show(); 
            }
            else{
                $("#btn-upload").hide();
                $("#btn-upload .badge").text("");
                $("#btn-cancel").hide();
            }
        });

        $("#btn-cancel").click(function(){
            $("#form-upload").get(0).reset();
            $("#btn-upload .badge").text("");
            $("#btn-upload").hide();
            $("#btn-cancel").hide();
        });


        /*<li class="list-group-item upload">
                                        <div class="file">
                                            <a href="Functional-requirements.docx"><i class="fa"></i> Functional-requirements.docx</a>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar  progress-bar-danger" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            
                                        </div>
                                    </li>*/


        $("#btn-upload").click(function(){
            $.each($("#input-upload")[0].files,function (ind,archivo){
                var elemento=document.createElement("li");
                elemento.setAttribute('class','list-group-item upload');
                var file=$('<div/>', {
                    'class':'file',
                }).appendTo(elemento);
                var link=$('<a/>',{
                    'html':'<i class="fa"></i> '+archivo.name+' '
                }).appendTo(file);
                var barra=$('<div/>',{
                    'class':'progress progress-striped active',
                    'html':'<div class="progress-bar  progress-bar-success" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100">0%</div>'
                }).appendTo(elemento);
                $(".work-files .list-group").prepend(elemento);
                var formData = new FormData();
                formData.append('archivo',archivo);
                subirDocumento(formData,elemento);
            });
        });


        function subirDocumento(formData,elemento){
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                            $(elemento).children(".progress").children(".progress-bar").css('width',percentComplete+'%').text(percentComplete+'%');
                        }
                }, false);
                return xhr;
                },
                url:window.location.pathname+"/subir-archivo",
                data: formData,
                processData: false,
                contentType: false,
                method:'POST',
                success: function(data){
                    if(data){
                        
                    }
                    else{
                        marcarErrorSubida(elemento);
                    }
                },
                error:function(){
                    marcarErrorSubida(elemento);
                }
            });
        }

        function marcarErrorSubida(elemento){
            $(elemento).children(".progress").removeClass("progress-striped active").children(".progress-bar").removeClass("progress-bar-success").addClass("progress-bar-danger").text("Error!").css('width','100%');
        }
    </script>
@endsection