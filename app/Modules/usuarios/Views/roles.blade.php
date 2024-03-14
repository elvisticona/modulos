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
            <fieldset class="form-group position-relative has-icon-left m-0">
                <input type="text" class="form-control" id="txtRol" placeholder="Buscar">
                <div class="form-control-position">
                    <i class="feather icon-search"></i>
                </div>
                <ix class="_name feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></ix>
            </fieldset>
            <hr>
            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                <button type="button" id="btnBuscar" class="btn btn-flat-primary mr-1 waves-effect waves-light">Buscar</button>
                <button type="button" id="accionRol" class="btn btn-flat-primary mr-1 waves-effect waves-light">Guardar</button>
            </div>

        </div>
    </div>
</div>

<div id="listaCard"></div>

@endsection


@section('izquierdaContent')
<div class="card">
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
<script src="../../../app-assets/js/scripts/class/R2024P.js"></script>
@endsection