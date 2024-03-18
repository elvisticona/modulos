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
    .select2-container .select2-selection--single {
        height: 40px;
        border-radius: 5px;
        border: solid 1px #7e7e7e;
    }
    .desborde{
        overflow: hidden; /* Oculta el desbordamiento */
        white-space: nowrap; /* Evita que el texto se divida en varias líneas */
        text-overflow: ellipsis; /* Añade puntos suspensivos al final del texto que no cabe */
    }
    #dtbHorario .table th, .table td{
        vertical-align: top !important;
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
                <h4 class="modal-title desborde" id="myModalLabel19">Horario del curso <br>
                    <div class="badge badge-square badge-primary">
                        <i class="fa fa-book"></i>
                        <span id="SpDenoCurso"></span>
                    </div>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
            
                <form id="formUsuarioHorario" autocomplete="off">
                    <div class="formUsuarioHorario mb-1" style="">
                        <div class="bd-example-row">
                            <div class="row m-0">
                                <div class="col-6 col-sm-3 p-0">
                                    <fieldset class="form-group position-relative has-icon-left m-0">
                                        <select class="form-control" id="cboTurnoHorario">
                                        </select>
                                        <div class="form-control-position">
                                            <i class="feather icon-clock" style="color: #C2C6DC;"></i>
                                        </div>
                                        <ix class="_turno feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="display: none;"></ix>
                                    </fieldset>
                                </div>
                                <div class="col-6 col-sm-3 p-0">
                                    <fieldset class="form-group position-relative has-icon-left m-0">
                                        <select class="form-control" id="cboAula">
                                        </select>
                                        <div class="form-control-position">                                                
                                            <i class="fa fa-map-marker" style="color: #C2C6DC;"></i>
                                        </div>
                                        <ix class="_miTokenAulaH feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="display: none;"></ix>
                                    </fieldset>
                                </div>
                                <div class="col-6 col-sm-3 p-0">
                                    <fieldset class="form-group position-relative has-icon-left m-0">
                                        <input type="time" id="txtHoraInicio" name="appt" min="06:00" max="23:00" class="form-control" />
                                        <div class="form-control-position">
                                            <i class="feather">Ini.</i>
                                        </div>
                                        <ix class="_horaInicio feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="display: none;"></ix>
                                    </fieldset>
                                </div>
                                <div class="col-6 col-sm-3 p-0">
                                    <fieldset class="form-group position-relative has-icon-left m-0">
                                        <input type="time" id="txtHoraFinal" name="appt" min="06:00" max="23:00" class="form-control" />
                                        <div class="form-control-position">
                                            <i class="feather">Fin.</i>
                                        </div>
                                        <ix class="_horaFinal feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="display: none;"></ix>
                                    </fieldset>
                                </div>
                                <div class="col-12 p-0">
                                    <div id="DiasSemana" class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                                        <label class="Lunes btn btn-outline-dark waves-effect p-75">
                                            <input id="Lunes" type="checkbox" class="btnAgregarHorario">
                                            <span class="d-none d-md-block">Lunes</span>
                                            <span class="d-sm-block d-md-none">Lu.</span>
                                        </label>
                                        <label class="Martes btn btn-outline-dark waves-effect p-75">
                                            <input id="Martes" type="checkbox" class="btnAgregarHorario">
                                            <span class="d-none d-md-block">Martes</span>
                                            <span class="d-sm-block d-md-none">Ma.</span>
                                        </label>
                                        <label class="Miercoles btn btn-outline-dark waves-effect p-75">
                                            <input id="Miercoles" type="checkbox" class="btnAgregarHorario">
                                            <span class="d-none d-md-block">Miércoles</span>
                                            <span class="d-sm-block d-md-none">Mi.</span>
                                        </label>
                                        <label class="Jueves btn btn-outline-dark waves-effect p-75">
                                            <input id="Jueves" type="checkbox" class="btnAgregarHorario">
                                            <span class="d-none d-md-block">Jueves</span>
                                            <span class="d-sm-block d-md-none">Ju.</span>
                                        </label>
                                        <label class="Viernes btn btn-outline-dark waves-effect p-75">
                                            <input id="Viernes" type="checkbox" class="btnAgregarHorario">
                                            <span class="d-none d-md-block">Viernes</span>
                                            <span class="d-sm-block d-md-none">Vi.</span>
                                        </label>
                                        <label class="Sabado btn btn-outline-dark waves-effect p-75">
                                            <input id="Sabado" type="checkbox" class="btnAgregarHorario">
                                            <span class="d-none d-md-block">Sábado</span>
                                            <span class="d-sm-block d-md-none">Sá.</span>
                                        </label>
                                        <label class="Domingo btn btn-outline-dark waves-effect p-75">
                                            <input id="Domingo" type="checkbox" class="btnAgregarHorario">
                                            <span class="d-none d-md-block">Domingo</span>
                                            <span class="d-sm-block d-md-none">Do.</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table id="dtbHorario" class="table table-bordered mb-0">
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
                                <td id="td_Domingo" class="p-0"></td>
                                <td id="td_Lunes" class="p-0"></td>
                                <td id="td_Martes" class="p-0"></td>
                                <td id="td_Miercoles" class="p-0"></td>
                                <td id="td_Jueves" class="p-0"></td>
                                <td id="td_Viernes" class="p-0"></td>
                                <td id="td_Sabado" class="p-0"></td>
                            </tr>
                        </tbody>
                    </table>
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