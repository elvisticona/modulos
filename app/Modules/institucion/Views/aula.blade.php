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

<div class="card listaAulaAlumno" style="display:none;">
    <div class="card-header d-flex justify-content-between">
        <h4>Aula, Alumnos</h4>
        <i class="feather icon-more-horizontal cursor-pointer"></i>
    </div>
    <div class="card-body p-1">
    <hr class="m-0">
        <br>
        <div id="listaAulaAlumno"></div>
        <button type="button" class="btn btn-primary w-100 mt-1 waves-effect waves-light"><i class="feather icon-plus mr-25"></i>Load More</button>
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
                        <div class="col-12 col-sm-6 p-0">
                            <fieldset class="form-group position-relative has-icon-left m-0">
                                <input type="text" id="txtDenominacion" class="form-control" placeholder="Denominación: ">
                                <div class="form-control-position">
                                <i class="feather icon-align-left"></i>
                                </div>
                                <ix class="_denominacion feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></ix>
                            </fieldset>
                        </div>
                        <div class="col-6 col-sm-3 p-0">
                            <fieldset class="form-group position-relative has-icon-left m-0">
                                <select class="form-control" id="cboSeccion">
                                    <option value="">Sección</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                    <option value="H">H</option>
                                    <option value="I">I</option>
                                    <option value="J">J</option>
                                    <option value="K">K</option>
                                    <option value="L">L</option>
                                    <option value="M">M</option>
                                    <option value="N">N</option>
                                    <option value="Ñ">Ñ</option>
                                    <option value="O">O</option>
                                    <option value="P">P</option>
                                    <option value="Q">Q</option>
                                    <option value="R">R</option>
                                    <option value="S">S</option>
                                    <option value="T">T</option>
                                    <option value="U">U</option>
                                    <option value="V">V</option>
                                    <option value="W">W</option>
                                    <option value="X">X</option>
                                    <option value="Y">Y</option>
                                    <option value="Z">Z</option>
                                </select>
                                <div class="form-control-position">
                                <i class="fa fa-sort-alpha-asc" style="color: #C2C6DC;"></i>
                                </div>
                                <ix class="_seccion feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></ix>
                            </fieldset>
                        </div>
                        <div class="col-6 col-sm-3 col-md-3 p-0">
                            <fieldset class="form-group position-relative has-icon-left" style="margin-top: 3px;margin-bottom: 0;">
                                    <div class="input-group input-group-lg">
                                        <input type="number" class="touchspin" id="txtCapacidad" value="50">
                                    </div>
                                <ix class="_capacidad feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></ix>
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
@endsection


@section('izquierdaContent')


<div class="card">
    <div class="card-header">
        <h4>Alumnos</h4>
        <i class="feather icon-more-horizontal cursor-pointer"></i>
    </div>
    <div class="card-body p-0">
        <hr class="m-0">

        <fieldset class="form-label-group form-group position-relative has-icon-left input-divider-left m-1">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control " id="txtbuscarAlumno" placeholder="Buscar">
                <button id="btnBuscarAlumno" class="btn btn-primary waves-effect waves-light btn-sm pl-1 pr-1" type="button" style="border-radius: inherit;">Ver</button>
                <button id="btnBuscarAlumnoAnular" class="btn btn-danger waves-effect waves-light btn-sm pl-1 pr-1" type="button" style="border-radius: inherit;display:none;">X</button>
            </div>
            <div class="form-control-position" style="top:-4px; z-index:3;">
                <i class="ficon feather icon-search" style="color:#fff;"></i>
            </div>
            <label for="txtbuscarAlumno">Buscar</label>
        </fieldset>

        <ul id="ulAlumnos" class="list-group list-group-flush customer-info"></ul>
    </div>
</div>

@endsection

@section('jsContent')

<script src="../../../app-assets/js/scripts/class/IN2024OA.js"></script>
@endsection