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
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row mb-2 mt-2">
            <div class="col-12 col-sm-12">
                    <div class="card-header p-0">
                        <h5>Colegio Trilce - Loreto</h5>
                        <button type="button" class="btn btn-icon btn-sm btn-flat-primary waves-effect waves-light"><i class="feather icon-edit" style="top:0px;"></i></button>
                    </div>
                    <p class="text-muted"><i class="feather icon-calendar"></i> Desde 2024</p>
                <hr>
                    <div class="card-header p-0">
                        <h5>Reseña histórica:</h5>
                        <button type="button" class="btn btn-icon btn-sm btn-flat-primary waves-effect waves-light"><i class="feather icon-edit" style="top:0px;"></i></button>
                    </div>
                    <p>El 7 de diciembre de 1979, un grupo de amigos, estudiantes de la UNI, decidieron fundar una academia preuniversitaria para postulantes a esa universidad; fue así que el primer lunes de enero de 1980 y con menos de una centena de estudiantes.</p>
                    <p>Actualmente, Trilce cuenta con 18 colegios en Lima, 6 en provincias, academias, 2000 trabajadores y más de 24 000 alumnos.</p>
                    <p class="font-weight-bold mb-25"> <i class="feather icon-map-pin mr-50 font-medium-2"></i>Jr. Callao 209, Cercado de Lima</p>
                    <p class="font-weight-bold mb-25"> <i class="feather icon-phone-call mr-50 font-medium-2"></i>+51 939 277 175</p>
                    <p class="font-weight-bold"> <i class="feather icon-mail mr-50 font-medium-2"></i>escuela@trilce.com</p>
                <hr>
                    <div class="card-header p-0">
                        <h5>Dirección:</h5>
                        <button type="button" class="btn btn-icon btn-sm btn-flat-primary waves-effect waves-light"><i class="feather icon-edit" style="top:0px;"></i></button>
                    </div>
                    <p>Actualmente, Trilce cuenta con 18 colegios en Lima, 6 en provincias, academias, 2000 trabajadores y más de 24 000 alumnos.</p>
                    <h5>Visión:</h5>
                    <p>Hacer de la educación un medio que logre un mundo mejor, para vivir generando el cambio que nuestra sociedad necesita.</p>
                    <h5>Misión:</h5>
                    <p>Cambiar la vida de nuestros estudiantes y colaboradores, generándoles pasión por alcanzar sus sueños.</p>
                    <p class="font-weight-bold mb-25"> <i class="feather icon-map-pin mr-50 font-medium-2"></i>Jr. Callao 209, Cercado de Lima</p>
                    <p class="font-weight-bold mb-25"> <i class="feather icon-phone-call mr-50 font-medium-2"></i>+51 939 277 175</p>
                    <p class="font-weight-bold"> <i class="feather icon-mail mr-50 font-medium-2"></i>escuela@trilce.com</p>
                <hr>
                    <button type="button" class="btn btn-icon rounded-circle btn-outline-primary mr-1 mb-1 waves-effect waves-light"><i class="feather icon-facebook"></i></button>
                    <button type="button" class="btn btn-icon rounded-circle btn-outline-info mr-1 mb-1 waves-effect waves-light"><i class="feather icon-twitter"></i></button>
                    <button type="button" class="btn btn-icon rounded-circle btn-outline-danger mr-1 mb-1 waves-effect waves-light"><i class="feather icon-youtube"></i></button>
                    <button type="button" class="btn btn-icon rounded-circle btn-outline-primary mr-1 mb-1 waves-effect waves-light"><i class="feather icon-instagram"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel18">Agregar turnos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

            <form id="formUsuario" autocomplete="off">
                        <div class="formulario mb-1" style="">
                            <div class="bd-example-row">
                                <div class="row m-0">
                                    
                                    <div class="col-12 p-0">
                                        <fieldset class="form-group position-relative has-icon-left m-0">
                                            <select class="form-control" id="cboTurno">
                                                <option value="">Turno</option>
                                                <option value="Mañana">Mañana</option>
                                                <option value="Tarde">Tarde</option>
                                                <option value="Noche">Noche</option>
                                            </select>
                                            <div class="form-control-position">
                                                <i class="feather icon-clock" style="color: #C2C6DC;"></i>
                                            </div>
                                            <ix class="_turno feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="display: none;"></ix>
                                        </fieldset>
                                    </div>
                                    <div class="col-6 p-0">
                                        <fieldset class="form-group position-relative has-icon-left m-0">
                                            <input type="time" id="txtHoraInicio" name="txtHoraInicio" class="form-control">
                                            <div class="form-control-position">
                                                <i class="feather">Ini.</i>
                                            </div>
                                            <ix class="_horaInicio feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="display: none;"></ix>
                                        </fieldset>
                                    </div>
                                    <div class="col-6 p-0">
                                        <fieldset class="form-group position-relative has-icon-left m-0">
                                            <input type="time" id="txtHoraFinal" name="txtHoraFinal" class="form-control">
                                            <div class="form-control-position">
                                                <i class="feather">Fin</i>
                                            </div>
                                            <ix class="_horaFinal feather icon-info cursor-pointer filtros animate__animated animate__bounce" data-toggle="tooltip" data-placement="top" title="" data-original-title="" style="display: none;"></ix>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <p class="m-0">NOTA: </p>
                Es importante definir los turnos de estudio que la institución dispondrá, estos turnos serán utilizados más adelante en el momento de crear los horarios.
            </div>
            <div class="modal-footer" style="border-color: rgb(255 255 255 / 25%);">
                <button type="button" id="btnGuardarTurno" class="btn btn-primary waves-effect waves-light">Guardar</button>
                <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('izquierdaContent')
<div class="card">
    <div class="card-header p-1">
        <h4>Turnos</h4>
        <button type="button" class="btn btn-icon btn-sm btn-flat-primary waves-effect waves-light" data-toggle="modal" data-target="#defaultSize">
            <i class="feather icon-plus cursor-pointer"></i>
        </button>
    </div>
    <div class="card-body p-0">
        <hr class="m-0">
        <div id="listaHorario"></div>
    </div>
</div>

@endsection

@section('jsContent')
<script src="../../../app-assets/js/scripts/class/I2024C.js"></script>
@endsection