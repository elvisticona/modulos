@extends('layouts.company')


@section('cssContent')
<style>
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
                <input type="text" class="form-control" id="email-search" placeholder="Buscar">
                <div class="form-control-position">
                    <i class="feather icon-search"></i>
                </div>
            </fieldset>
            <hr>

            <div class="btn-group btn-block" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-flat-primary mr-1 waves-effect waves-light">Buscar</button>
                <button type="button" class="btn btn-flat-primary mr-1 waves-effect waves-light">Agregar</button>
            </div>

        </div>
    </div>
</div>

<div id="listaCard"></div>

@endsection


@section('izquierdaContent')
<div class="card">
    <div class="card-header">
        <h4>Importante</h4>
        <i class="feather icon-info cursor-pointer"></i>
    </div>
    <div class="card-body pt-0">
        <hr class="m-0">
        <br>
        <p>Para facilitar la administración del sistema y garantizar la eficiencia en la creación de permisos, esta sección es exclusivamente gestionada por el desarrollador. Estamos dispuestos a brindarle apoyo y coordinar la integración de nuevos módulos para mejorar su experiencia laboral.</p>
        <p>A continuación, le proporcionamos información de contacto para que pueda comunicarse con nosotros mediante número telefónico o correo electrónico:</p>
        <div class="mt-1">
            <h6 class="mb-0">Nombre:</h6>
            <p>Elvis Ticona Ojeda</p>
        </div>
        <div class="mt-1">
            <h6 class="mb-0">Celular:</h6>
            <p>+51 939 277 175</p>
        </div>
        <div class="mt-1">
            <h6 class="mb-0">Crreo:</h6>
            <p>ticona.ojeda@gmail.com</p>
        </div>
        <div class="mt-1">
            <h6 class="mb-0">Faacebook:</h6>
            <a href="https://web.facebook.com/elvis.ticonaojeda" target="_blank">elvis.ticonaojeda</a>
        </div>
    </div>
</div>
@endsection

@section('jsContent')
<script src="../../../app-assets/js/scripts/class/P2024ON.js"></script>
@endsection