@extends('administrador.dashboard')
@section('contenido')
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Titulo del proyecto</h2>
                <div class="clearfix"></div>
            </div>


            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Información general</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Participantes</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Plan y ejecución</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    <!-- start accordion -->
                    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Datos generales</h4>
                        </a>
                        <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <div class="form-horizontal form-label-left">

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <label class="control-label col-md-3">Titulo:</label>
                                        <p style="margin-top:7px" class="col-md-9">aqui va el titulo del proyecto</p>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <label class="control-label col-md-3">Tipo de proyecto:</label>
                                        <p style="margin-top:7px" class="col-md-9">aqui va el tipo de proyecto</p>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <label class="control-label col-md-3">Fecha inicio:</label>
                                        <p style="margin-top:7px" class="col-md-9">24/07/2021</p>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                        <label class="control-label col-md-3">Fecha fin:</label>
                                        <p style="margin-top:7px" class="col-md-9">12/02/2022</p>
                                    </div>
                                </div>

                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Mas informacion</h4>
                        </a>
                        <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <p><strong>Collapsible Item 2 data</strong>
                            </p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree1" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title">Mas informacion</h4>
                        </a>
                        <div id="collapseThree1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <p><strong>Collapsible Item 3 data</strong>
                            </p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion -->
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                    <!-- start accordion -->
                    <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne2" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Equipo de investigación</h4>
                        </a>
                        <div id="collapseOne2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">


                            <div class="col-md-6 col-sm-6 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>Lider del proyecto</i></h4>
                            <div class="left col-xs-7">
                              <h2>Nicole Pearson</h2>
                              <p><strong>About: </strong> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Address: </li>
                                <li><i class="fa fa-phone"></i> Phone #: </li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="{{asset('images/img.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                                <!-- otro boton por aca-->
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> Ver Perfil
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>   



                    <div class="col-md-6 col-sm-6 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>Investigador</i></h4>
                            <div class="left col-xs-7">
                              <h2>Nicole Pearson</h2>
                              <p><strong>About: </strong> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Address: </li>
                                <li><i class="fa fa-phone"></i> Phone #: </li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="{{asset('images/img.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                                <!-- otro boton por aca-->
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> Ver Perfil
                              </button>
                            </div>
                          </div>
                        </div>
                      </div> 




                        <div class="col-md-6 col-sm-6 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>Estudiante</i></h4>
                            <div class="left col-xs-7">
                              <h2>Nicole Pearson</h2>
                              <p><strong>About: </strong> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-building"></i> Address: </li>
                                <li><i class="fa fa-phone"></i> Phone #: </li>
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="{{asset('images/img.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                                <!-- otro boton por aca-->
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> Ver Perfil
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>   





                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo2" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Mas informacion</h4>
                        </a>
                        <div id="collapseTwo2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <p><strong>Collapsible Item 2 data</strong>
                            </p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree2" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree2" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title">Mas informacion</h4>
                        </a>
                        <div id="collapseThree2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <p><strong>Collapsible Item 3 data</strong>
                            </p>
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion -->


                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                  <!--modal-->

                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch demo modal
                  </button>

                  <div id="exampleModal" class="modal" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Modal title</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <p>Modal body text goes here.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal-->

                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection