@extends('administrador.dashboard')
@section('estilos')
<style>
    .section_delivery{
        display: flex;
        flex-wrap: wrap;
    }

    .delivery_details{
        width: 70%;
        padding-right: 15px;
    }

    .delivery_details .message{
        font-size: 14px;
    }

    .delivery_details .heading{
        font-size: 15px;
    }

    .delivery_details .person{
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        font-size: 17px;
    }

    .person .person_pic{
        max-width: 60px;
        margin-right: 10px;
    }

    .person_pic img{
        width: 100%;
    }

    .send_message{
        display: flex;
        align-items: center;
    }

    .control input{
        width: 100%;
        border: none;
    }

    .send_message .control{
        width: 80%;
        display: flex;
        justify-content: space-between;
        border: 2px solid gray;
        border-radius: 30px;
        padding: 5px 15px;
    }

    .control button{ 
        background-color: white;
        border: none;
        font-size: 17px;
        padding: 0;
        margin: 0;
    }

    .send_message .icon{
        /*background-color: #E6E9ED;*/
        font-size: 25px;
        margin-right: 15px;
    }

    .delivery-files{
        width: 30%;
    }

    .delivery-files-container{
        box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -webkit-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -moz-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        -ms-box-shadow: 0 1px 2px 0 rgb(60 64 67 / 30%), 0 2px 6px 2px rgb(60 64 67 / 15%);
        border-radius: 0.5rem;
        padding: 15px;
    }

    .delivery-files-container .header{
        text-align: center;
        margin-bottom: 15px;
    }

    .delivery-files-container .header h3{
        margin: 0;
        padding: 0;
        font-size: 20px;
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

            <div class="section_delivery">
                <div class="delivery_details">
                    <div class="person">
                        <div class="person_pic">
                            <img class="img-circle" src="{{asset('images/user.png')}}" alt="...">
                        </div>
                        <div class="person_info">
                            <span>Nombre del estudiante</span>
                        </div>

                    </div>

                        <div>

                            <h4><i class="fa fa-comments"></i> Comentarios</h4>

                            <!-- end of user messages -->
                            <ul class="messages">
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-info">24</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Desmond Davison</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br/>
                                </div>
                              </li>
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-error">21</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Brian Michaels</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br />
                                </div>
                              </li>
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-info">24</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Desmond Davison</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br />
                                </div>
                              </li>
                            </ul>

                            <div class="send_message">
                            
                                <span class="icon fa fa-comment"></span>
                                
                                <div class="control">
                                    <input type="text" placeholder="Añadir un comentario...">
                                    <button><span class="fa fa-send"></span></button>
                                </div>
                            </div>
                            <!-- end of user messages -->
                        </div>

                </div>

                <div class="delivery-files">
                    <div class="delivery-files-container">
                        <div class="header">
                            <h3>Entrega</h3>
                        </div>

                        <div class="files">
                            <div class="file">
                                <a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
                            </div>

                            <div class="file">
                                <a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
                            </div>

                            <div class="file">
                                <a href=""><i class="fa fa-file-pdf-o"></i> UAT.pdf</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection