@extends('layouts.company')


@section('cssContent')
<style>
    .caardSelected{
        background-color: rgba(115, 103, 240, 0.05) !important;
        color: #7367F0 !important;
        box-shadow: 0 0 1px 0 #7367F0 !important;
        border-radius: 5px;
    }
    .micard{
        cursor: pointer;
    }
    .filtros{
        position: absolute;
        right: 5px;
        top: 10px;
        color: red;
        display:none;
    }
    .horario{
        background: #0f163a6b;
        border: solid 0.5px #706969;
    }
</style>
@endsection

@section('derechaContent')
<?php 
$url_parts = parse_url($_SERVER['REQUEST_URI']);
$menu=$url_parts['path'];
$subcadenas = explode("/", $menu);
$ultimo_elemento = end($subcadenas);
?>
<div class="card">
    <div class="card-header">
        <h4>Administrar </h4>
        <i class="feather icon-more-horizontal cursor-pointer"></i>
    </div>
    <div class="card-body p-1">
        <hr class="m-0">
        <br>
        <ul class="list-group list-group-flush customer-info">
            <li class="list-group-item <?php if (strpos($ultimo_elemento, "institucion") !== false) {echo 'ulLiActive';} else {echo '';} ?>"
                style="border-top: 0;">
                <a href="{{ url('/institucion') }}" class="d-flex justify-content-between">
                    <div class="series-info">
                        <i class="feather icon-home text-primary"></i>
                        <span class="text-bold-600">Institucion</span>
                    </div>
                    <div class="product-result">
                        <span id="countInstitucion">1</span>
                    </div>
                </a>
            </li>
            <li
                class="list-group-item <?php if (strpos($ultimo_elemento, "aula") !== false) {echo 'ulLiActive';} else {echo '';} ?>">
                <a href="{{ url('/institucion/aula') }}" class="d-flex justify-content-between">
                    <div class="series-info">
                        <i class="feather icon-grid text-warning"></i>
                        <span class="text-bold-600">Aulas</span>
                    </div>
                    <div class="product-result">
                        <span id="countAulas"></span>
                    </div>
                </a>
            </li>
            <li
                class="list-group-item <?php if (strpos($ultimo_elemento, "curso") !== false) {echo 'ulLiActive';} else {echo '';} ?>">
                <a href="{{ url('/institucion/curso') }}" class="d-flex justify-content-between">
                    <div class="series-info">
                        <i class="feather icon-book text-danger"></i>
                        <span class="text-bold-600">Cursos</span>
                    </div>
                    <div class="product-result">
                        <span id="countCursos"></span>
                    </div>
                </a>
            </li>
        </ul>

    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4>Docentes</h4>
        <i class="feather icon-more-horizontal cursor-pointer"></i>
    </div>
    <div class="card-body p-0">
        <hr class="m-0">
        <br>
        <ul id="ulDocentes" class="list-group list-group-flush customer-info">
        <li class="list-group-item" style="border-top: 0;">
                <div class="d-flex justify-content-between">
                    <fieldset>
                        <div class="vs-checkbox-con vs-checkbox-primary">
                            <input type="checkbox" value="false">
                            <span class="vs-checkbox vs-checkbox-sm">
                                <span class="vs-checkbox--check">
                                    <i class="vs-icon feather icon-check"></i>
                                </span>
                            </span>
                            <span class=""> Elvis ticona ojeda</span>
                        </div>
                    </fieldset>
                    <div class="product-result"><i class="feather icon-user font-small-3 text-primary"></i></div>
                </div>
            </li>

            <li class="list-group-item" style="border-top: 0;">
                <div class="d-flex justify-content-between">
                    <fieldset>
                        <div class="vs-checkbox-con vs-checkbox-primary">
                            <input type="checkbox" value="false">
                            <span class="vs-checkbox vs-checkbox-sm">
                                <span class="vs-checkbox--check">
                                    <i class="vs-icon feather icon-check"></i>
                                </span>
                            </span>
                            <span class=""> Eva evelin Elvis ticona ojeda</span>
                        </div>
                    </fieldset>
                    <div class="product-result"><i class="feather icon-user font-small-3 text-warning"></i></div>
                </div>
            </li>

            <li class="list-group-item" style="border-top: 0;">
                <div class="d-flex justify-content-between">
                    <fieldset>
                        <div class="vs-checkbox-con vs-checkbox-primary">
                            <input type="checkbox" value="false">
                            <span class="vs-checkbox vs-checkbox-sm">
                                <span class="vs-checkbox--check">
                                    <i class="vs-icon feather icon-check"></i>
                                </span>
                            </span>
                            <span class=""> Elizabeth Corrales Quispe</span>
                        </div>
                    </fieldset>
                    <div class="product-result"><i class="feather icon-user font-small-3 text-danger"></i></div>
                </div>
            </li>

        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body pt-1 pb-1">
        <div class="justify-content-start align-items-center mb-0">
            <div class="divInicio">
                <fieldset class="form-group position-relative has-icon-left m-0">
                    <input type="text" class="form-control" id="email-search" placeholder="Buscar aula">
                    <div class="form-control-position">
                        <i class="feather icon-search"></i>
                    </div>
                </fieldset>
            </div>
            <form id="formUsuario" class="formulario animate__bounceIn animate__zoomIn" autocomplete="off" style="display:none;">
                <div class="bd-example-row">
                    <div class="row m-0">
                        <div class="col-12 col-sm-12 p-0">
                            <fieldset class="form-group position-relative has-icon-left m-0">
                                <input type="text" id="txtDenominacion" class="form-control" placeholder="Denominación: ">
                                <div class="form-control-position">
                                <i class="feather icon-align-left"></i>
                                </div>
                                <!-- <ix class="_name feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></ix> -->
                            </fieldset>
                        </div>  
                        <div class="col-12 col-sm-12 p-0">
                            <fieldset class="form-group position-relative has-icon-left m-0">
                                <textarea class="form-control" id="txtDescripcion" rows="3" placeholder="Descripción:"></textarea>
                                <div class="form-control-position">
                                <i class="feather icon-align-center"></i>
                                </div>
                                <!-- <ix class="_apellidos feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></ix> -->
                            </fieldset>
                        </div>  
                        <div class="col-9 col-sm-10 p-0 mt-1">
                            <button type="button" id="btnGuardar" class="btn btn-flat-primary btn-block waves-effect waves-light">Guardar</button>
                        </div>
                        <div class="col-3 col-sm-2 p-0 mt-1">
                            <button type="button" id="btnAnularForm" class="btn btn-flat-danger btn-block waves-effect waves-light">X</button>
                        </div>
                    </div>
                </div>
            </form>


            <div class="divInicio">
                <hr>
                <div class="btn-group btn-block" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-flat-primary mr-1 waves-effect waves-light">Buscar</button>
                    <button type="button" id="btnFormulario" class="btn btn-flat-primary mr-1 waves-effect waves-light">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="listaCard"></div>

<div class="col-12 text-center">
    <button type="button" class="btn btn-primary block-element mb-1 waves-effect waves-light">+ 20</button>
</div>

<div class="modal fade text-left" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content" style="border: solid 1px #818181;border-radius: 2px;">
            <div class="modal-header" style="border-radius: initial;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true">Configurar docente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">Configurar horario</a>
                    </li>
                </ul>    
                <div class="tab-content">
                    <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel" style="background-color: transparent;">
                        
                        <div id="listaAulasDocente" class="p-1"></div>

                    </div>
                    <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel" style="background-color: transparent;">


                    <form id="formUsuario" autocomplete="off">
                        <div class="formulario mb-1" style="">
                            <div class="bd-example-row">
                                <div class="row m-0">
                                    <div class="col-6 col-sm-4 p-0">
                                        <fieldset class="form-group position-relative has-icon-left m-0">
                                            <input type="text" id="txtCurso" class="form-control" placeholder="Matematicas" readonly="readonly" style="opacity: initial;">
                                            <div class="form-control-position">
                                            <i class="fa fa-book"></i>
                                            </div>
                                            <!-- <ix class="_name feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="display: none;"></ix> -->
                                        </fieldset>
                                    </div>
                                    <div class="col-6 col-sm-4 p-0">
                                        <fieldset id="txtCboAula" class="form-group position-relative has-icon-left m-0">
                                            <select class="form-control" id="cboTipoUsuario">
                                                <option value="">Matematicas comunicacion fisica</option>
                                                <option value="Director">Matematicas comunicacion fisica/a.</option>
                                                <option value="Secretario">Matematicas comunicacion fisica/a.</option>
                                                <option value="Docente">DMatematicas comunicacion fisicaocente.</option>
                                                <option value="Auxiliar">Matematicas comunicacion fisica.</option>
                                                <option value="Alumno">Matematicas comunicacion fisica/a.</option>
                                            </select>
                                            <div class="form-control-position">                                                
                                                <i class="fa fa-map-marker" style="color: #C2C6DC;"></i>
                                            </div>
                                            <!-- <ix class="_tipo feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="display: none;"></ix> -->
                                        </fieldset>
                                    </div>
                                    <div class="col-12 col-sm-4 p-0">
                                        <fieldset id="txtCboAula" class="form-group position-relative has-icon-left m-0">
                                            <select class="form-control" id="cboTipoUsuario">
                                                <option value="">Turno</option>
                                                <option value="Director">Mañana</option>
                                                <option value="Secretario">Tarde</option>
                                                <option value="Docente">Noche</option>
                                            </select>
                                            <div class="form-control-position">
                                                <i class="feather icon-sliders" style="color: #C2C6DC;"></i>
                                            </div>
                                            <!-- <ix class="_tipo feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="display: none;"></ix> -->
                                        </fieldset>
                                    </div>
                                    <div class="col-6 col-sm-3 p-0">
                                        <fieldset class="form-group position-relative has-icon-left m-0">
                                            <input type="time" id="appt" name="appt" min="09:00" max="18:00" class="form-control" />
                                            <div class="form-control-position">
                                                <i class="feather icon-user"></i>
                                            </div>
                                            <!-- <ix class="_name feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="display: none;"></ix> -->
                                        </fieldset>
                                    </div>
                                    <div class="col-6 col-sm-2 p-0">
                                        <fieldset class="form-group position-relative has-icon-left m-0">
                                            <input type="time" id="appt" name="appt" min="09:00" max="18:00" class="form-control" />
                                            <div class="form-control-position">
                                                <i class="feather icon-user"></i>
                                            </div>
                                            <!-- <ix class="_name feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="display: none;"></ix> -->
                                        </fieldset>
                                    </div>
                                    <div class="col-2 col-sm-1 col-md-1 p-0">
                                        <div class="form-control">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="customCheck" id="lunes">
                                                    <label class="custom-control-label" for="lunes">Lu.</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-1 col-md-1 p-0">
                                        <div class="form-control">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="customCheck" id="martes">
                                                    <label class="custom-control-label" for="martes">Ma.</label>                                                    
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-1 col-md-1 p-0">
                                        <div class="form-control">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="customCheck" id="miiercoles">
                                                    <label class="custom-control-label" for="miiercoles">Mi.</label>                                                    
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-1 col-md-1 p-0">
                                        <div class="form-control">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="customCheck" id="jueves">
                                                    <label class="custom-control-label" for="jueves">Ju.</label>                                                    
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-1 col-md-1 p-0">
                                        <div class="form-control">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="customCheck" id="viernes">
                                                    <label class="custom-control-label" for="viernes">Vi.</label>                                                    
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-1 col-md-1 p-0">
                                        <div class="form-control">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="customCheck" id="sabado">
                                                    <label class="custom-control-label" for="sabado">Sa.</label>                                                    
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-1 col-md-1 p-0">
                                        <div class="form-control">
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="customCheck" id="domingo">
                                                    <label class="custom-control-label" for="domingo">Do.</label>                                                    
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>

<hr>

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>DOMINGO</th>
                                        <th>LUNES</th>
                                        <th>MARTES</th>
                                        <th>MIÉRCOLES</th>
                                        <th>JUEVES</th>
                                        <th>VIERNES</th>
                                        <th>SÁBADO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="" class="p-0"></td>
                                        <td id="" class="p-0">
                                            <div class="horario p-1">
                                                <small class="text-muted">Hora</small><br>
                                                <h6>07:00 - 08:00</h6>
                                                <small class="text-muted">Curso</small><br>
                                                <h6>Matematicas comunicacion fisica religion</h6>
                                            </div>
                                            <div class="horario p-1">
                                                <small class="text-muted">Hora</small><br>
                                                <h6>07:00 - 08:00</h6>
                                                <small class="text-muted">Curso</small><br>
                                                <h6>Matematicas comunicacion fisica religion</h6>
                                            </div>
                                        </td>
                                        <td id="" class="p-0">
                                        <div class="horario p-1">
                                                <small class="text-muted">Hora</small><br>
                                                <h6>07:00 - 08:00</h6>
                                                <small class="text-muted">Curso</small><br>
                                                <h6>Matematicas comunicacion fisica religion</h6>
                                            </div>
                                            <div class="horario p-1">
                                                <small class="text-muted">Hora</small><br>
                                                <h6>07:00 - 08:00</h6>
                                                <small class="text-muted">Curso</small><br>
                                                <h6>Matematicas comunicacion fisica religion</h6>
                                            </div>
                                        </td>
                                        <td id="" class="p-0">
                                        <div class="horario p-1">
                                                <small class="text-muted">Hora</small><br>
                                                <h6>07:00 - 08:00</h6>
                                                <small class="text-muted">Curso</small><br>
                                                <h6>Matematicas comunicacion fisica religion</h6>
                                            </div>
                                            <div class="horario p-1">
                                                <small class="text-muted">Hora</small><br>
                                                <h6>07:00 - 08:00</h6>
                                                <small class="text-muted">Curso</small><br>
                                                <h6>Matematicas comunicacion fisica religion</h6>
                                            </div>
                                        </td>
                                        <td id="" class="p-0">
                                        <div class="horario p-1">
                                                <small class="text-muted">Hora</small><br>
                                                <h6>07:00 - 08:00</h6>
                                                <small class="text-muted">Curso</small><br>
                                                <h6>Matematicas comunicacion fisica religion</h6>
                                            </div>
                                            <div class="horario p-1">
                                                <small class="text-muted">Hora</small><br>
                                                <h6>07:00 - 08:00</h6>
                                                <small class="text-muted">Curso</small><br>
                                                <h6>Matematicas comunicacion fisica religion</h6>
                                            </div>
                                        </td>
                                        <td id="" class="p-0">
                                        <div class="horario p-1">
                                                <small class="text-muted">Hora</small><br>
                                                <h6>07:00 - 08:00</h6>
                                                <small class="text-muted">Curso</small><br>
                                                <h6>Matematicas comunicacion fisica religion</h6>
                                            </div>
                                            <div class="horario p-1">
                                                <small class="text-muted">Hora</small><br>
                                                <h6>07:00 - 08:00</h6>
                                                <small class="text-muted">Curso</small><br>
                                                <h6>Matematicas comunicacion fisica religion</h6>
                                            </div>
                                        </td>
                                        <td id="" class="p-0"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('izquierdaContent')
<div class="card">
    <div class="card-header">
        <h4>Aulas</h4>
        <i class="feather icon-more-horizontal cursor-pointer"></i>
    </div>
    <div class="card-body p-0">
        <hr class="m-0">
        <fieldset class="form-label-group form-group position-relative has-icon-left input-divider-left m-1">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control " id="txtBuscarAula" placeholder="Buscar">
                <button id="btnBuscarAlumno" class="btn btn-primary waves-effect waves-light btn-sm pl-1 pr-1" type="button" style="border-radius: inherit;">Ver</button>
                <button id="btnBuscarAlumnoAnular" class="btn btn-danger waves-effect waves-light btn-sm pl-1 pr-1" type="button" style="border-radius: inherit;display:none;">X</button>
            </div>
            <div class="form-control-position" style="top:-4px; z-index:3;">
                <i class="ficon feather icon-search" style="color:#fff;"></i>
            </div>
            <label for="txtBuscarAula">Buscar</label>
        </fieldset>
        <ul id="ulAulas" class="list-group list-group-flush customer-info"></ul>
    </div>
</div>
@endsection

@section('jsContent')
<script src="../../../app-assets/js/scripts/class/IN2024C.js"></script>
@endsection