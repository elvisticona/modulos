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
            <li class="list-group-item <?php if (strpos($ultimo_elemento, "usuarios") !== false) {echo 'ulLiActive';} else {echo '';} ?>"
                style="border-top: 0;">
                <a href="{{ url('/usuarios') }}" class="d-flex justify-content-between">
                    <div class="series-info">
                        <i class="feather icon-users text-primary"></i>
                        <span class="text-bold-600">Usuarios</span>
                    </div>
                    <div class="product-result">
                        <span id="countUser"></span>
                    </div>
                </a>
            </li>
            <li
                class="list-group-item <?php if (strpos($ultimo_elemento, "roles") !== false) {echo 'ulLiActive';} else {echo '';} ?>">
                <a href="{{ url('/usuarios/roles') }}" class="d-flex justify-content-between">
                    <div class="series-info">
                        <i class="feather icon-grid text-warning"></i>
                        <span class="text-bold-600">Roles</span>
                    </div>
                    <div class="product-result">
                        <span id="countRol"></span>
                    </div>
                </a>
            </li>
            <li
                class="list-group-item <?php if (strpos($ultimo_elemento, "permisos") !== false) {echo 'ulLiActive';} else {echo '';} ?>">
                <a href="{{ url('/usuarios/permisos') }}" class="d-flex justify-content-between">
                    <div class="series-info">
                        <i class="feather icon-list text-danger"></i>
                        <span class="text-bold-600">Permisos</span>
                    </div>
                    <div class="product-result">
                        <span id="countPermisos"></span>
                    </div>
                </a>
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
                    <input type="text" class="form-control" id="email-search" placeholder="Buscar por nombre ó documento">
                    <div class="form-control-position">
                        <i class="feather icon-search"></i>
                    </div>
                </fieldset>
            </div>
            
            <form id="formUsuario">
                <div class="formulario animate__bounceIn animate__zoomIn" style="display:none;">
                    <div class="bd-example-row">
                        <div class="row m-0">
                            <div class="col-6 p-0">
                                <fieldset class="form-group position-relative has-icon-left m-0">
                                    <input type="text" id="txtNombre" class="form-control" placeholder="Nombres: ">
                                    <div class="form-control-position">
                                        <i class="feather icon-user"></i>
                                    </div>
                                    <ix class="_name feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></ix>
                                </fieldset>
                            </div>
                            <div class="col-6 p-0">
                                <fieldset class="form-group position-relative has-icon-left m-0">
                                    <input type="text" id="txtApellido" class="form-control" placeholder="Apellidos: ">
                                    <div class="form-control-position">
                                    <i class="feather icon-menu"></i>
                                    </div>
                                    <ix class="_apellidos feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></ix>
                                </fieldset>
                            </div>
                            <div class="col-6 col-sm-4 col-md-4 p-0">
                                <fieldset class="form-group position-relative has-icon-left m-0">
                                    <input type="text" id="txtDDocumento" class="form-control" placeholder="Documento: ">
                                    <div class="form-control-position">
                                    <i class="feather icon-credit-card"></i>
                                    </div>
                                    <ix class="_dni feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></ix>
                                </fieldset>
                            </div>
                            <div class="col-6 col-sm-4 col-md-3 p-0">
                                <fieldset class="form-group position-relative has-icon-left m-0">
                                    <input type="text" id="txtCelular" class="form-control" placeholder="Celular: ">
                                    <div class="form-control-position">
                                    <i class="feather icon-phone-call"></i>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-12 col-sm-4 col-md-5 p-0">
                                <fieldset class="form-group position-relative has-icon-left m-0">
                                    <input type="text" id="txtCorreo" class="form-control" placeholder="Correo: ">
                                    <div class="form-control-position">
                                        <i class="feather icon-mail"></i>
                                    </div>
                                    <ix class="_email feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></ix>
                                </fieldset>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 p-0">
                                <fieldset class="form-group position-relative has-icon-left m-0">
                                    <select class="form-control" id="cboTipoUsuario">
                                        <option value="">Tipo de usuario</option>
                                        <option value="Director">Director/a.</option>
                                        <option value="Secretario">Secretario/a.</option>
                                        <option value="Docente">Docente.</option>
                                        <option value="Auxiliar">Auxiliar.</option>
                                        <option value="Alumno">Alumno/a.</option>
                                    </select>
                                    <div class="form-control-position">
                                        <i class="feather icon-sliders" style="color: #C2C6DC;"></i>
                                    </div>
                                    <ix class="_tipo feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></ix>
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
        <h4>Roles</h4>
        <i class="feather icon-more-horizontal cursor-pointer"></i>
    </div>
    <div class="card-body pt-0">
        <hr class="m-0">
        <br>
        <ul id="ulRole" class="list-group list-group-flush customer-info"></ul>
    </div>
</div>


<div class="card llistaPermiso" style="display:none;">
    <div class="card-header">
        <h4>Permisos</h4>
        <i class="feather icon-more-horizontal cursor-pointer"></i>
    </div>
    <div class="card-body pt-0">
        <hr class="m-0">
        <br>
        <ul id="ulPermisos" class="list-group list-group-flush customer-info"></ul>

    </div>
</div>
@endsection

@section('jsContent')
<script src="../../../app-assets/js/scripts/class/U2024.js"></script>
@endsection