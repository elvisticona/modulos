@extends('layouts.auth')

@section('cssContent')
<style>
.fondo {
    opacity: .5;
    width: 100%;
    height: 100%;
    transition: all .3s ease;
    transition-delay: .1s;
    position: absolute;
    top: 0;
}
</style>
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/login.css">
@endsection

@section('content')
<div class="row fondo">
    <div class=" col-md-6 col-sm-6 col-6 fondo1 m-0 p-0">
        <div class="sombra df1 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-12.jpg)"></div>
        <div class="sombra df2 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-11.jpg)"></div>
        <div class="sombra df3 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-10.jpg)"></div>
        <div class="sombra df4 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-9.jpg)"></div>
        <div class="sombra df5 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-8.jpg)"></div>
        <div class="sombra df6 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-7.jpg)"></div>
        <div class="sombra df7 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-6.jpg)"></div>
        <div class="sombra df8 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-1.jpg)"></div>
        <div class="sombra df9 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-4.jpg)"></div>
        <div class="sombra df10 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-3.jpg)"></div>
        <div class="sombra df11 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-2.jpg)"></div>
    </div>
    <div class=" col-md-6 col-sm-6 col-6 fondo2 m-0 p-0">
        <div class="sombra df12 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-24.jpg)"></div>
        <div class="sombra df13 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-23.jpg)"></div>
        <div class="sombra df14 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-22.jpg)"></div>
        <div class="sombra df15 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-21.jpg)"></div>
        <div class="sombra df16 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-20.jpg)"></div>
        <div class="sombra df17 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-19.jpg)"></div>
        <div class="sombra df18 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-18.jpg)"></div>
        <div class="sombra df19 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-17.jpg)"></div>
        <div class="sombra df20 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-16.jpg)"></div>
        <div class="sombra df21 animate__animated animate__flipInX"
            style="background-image:url(../../../app-assets/images/portrait/small/avatar-s-15.jpg)"></div>
    </div>
</div>
<section class="row flexbox-container">
    <div class="col-xl-8 col-11 d-flex justify-content-center">
        <div class="card bg-authentication rounded-0 mb-0">
            <div class="row m-0">
                <!-- <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                    <img src="../../../app-assets/images/pages/login.png" alt="branding logo">
                </div> -->
                <div class="col-lg-12 col-12 p-0">
                    <div class="card rounded-0 mb-0 px-2">
                        <div class="card-header pb-1">
                            <div class="card-title">
                                <h4 class="mb-0">Inicia sesión</h4>
                            </div>
                        </div>
                        <p class="px-2">Bienvenido, inicie sesión en su cuenta.</p>
                        <div class="card-content">
                            <div class="card-body pt-1">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                        <input id="user-name" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="Usuario" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="form-control-position">
                                            <i class="feather icon-user"></i>
                                        </div>
                                        <label for="user-name">Usuario</label>
                                    </fieldset>


                                    <fieldset class="form-label-group position-relative has-icon-left">
                                        <input id="user-password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" placeholder="Contraseña">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="form-control-position">
                                            <i class="feather icon-lock"></i>
                                        </div>
                                        <label for="user-password">Contraseña</label>
                                    </fieldset>

                                    <div class="form-group d-flex justify-content-between align-items-center">
                                        <div class="text-left">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" name="remember" id="remember"
                                                        {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Remember me</span>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <!-- <div class="text-right"><a href="auth-forgot-password.html"
                                                class="card-link">Forgot Password?</a></div> -->
                                    </div>
                                    <a href="#" class="btn btn-outline-primary float-left btn-inline pl-1 pr-1">Información</a>
                                    <button type="submit" class="btn btn-primary float-right btn-inline pl-1 pr-1">Ingresar</button>
                                </form>
                            </div>
                        </div>
                        <div class="login-footer text-center">
                            <div class="divider mt-2 mb-0">
                                <div class="divider-text">Encuéntranos en:</div>
                            </div>
                            <div class="footer-btn d-inline">
                                <a href="#" id="btn1" class="btn btn-facebook"><span class="fa fa-facebook"></span></a>
                                <a href="#" class="btn btn-twitter white"><span class="fa fa-twitter"></span></a>
                                <a href="#" class="btn btn-google"><span class="fa fa-google"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('jsContent')
<script>
$(document).ready(function() {

    setInterval(function() {
        var numeroAleatorio = Math.floor(Math.random() * 21) + 1;
        $('.df' + numeroAleatorio).toggleClass('animate__flipInX');
    }, 1000);

});
</script>
@endsection