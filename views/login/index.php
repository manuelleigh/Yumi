<?php if(isset($_GET["pc"])){Session::set('host_pc', 'PC0'.$_GET["pc"]);} ?>
<div id="wrapper-1" style="display: block;">
    <link href="<?php echo URL; ?>public/css/style.min.css" id="theme" rel="stylesheet">
    <div class="row auth-wrapper gx-0">
        <div class="col-lg-8 col-xl-8 bg-primary auth-box-2 on-sidebar hidden-md-down" style="background-image:url(<?php echo URL; ?>public/images/background/fondo-newlogin-new.jpg); background-size: cover;">
            <!-- <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="row justify-content-center text-center">
                    <div class="col-md-7 col-lg-12 col-xl-9">
                        <a href="javascript:void(0)" class="text-center db"><img src="<?php echo URL; ?>public/images/logo-insaga-white.png"/></a>
                        <h2 class="text-white mt-4 fw-light">INSAGA <span class="font-weight-medium text-warning">.REST</span></h2>
                        <h5 class="text-white mt-0 fw-light">Ver 2.0</h5>
                        <p class="op-5 text-white fs-4 mt-4">Encargate de la comida, Nosotros del resto.</p>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="col-md-12 col-lg-4 col-xl-4 d-flex align-items-center justify-content-center estilo-login">
            <div class="row justify-content-center w-100 mt-1 mt-lg-0 px-5">
                <div class="col-11">
                    <div id="loginform">
                        <img src="<?php echo URL; ?>public/images/yumi.png" style="width: 100%;max-width: 240px;margin: 0 auto;display: block;" class="mb-2"/>
                        <h3 class="text-center estilo-login-text">Bienvenido!</h3>
                        <p class="text-center estilo-login-text">Ingrese sus datos de acceso</p>
                        <form class="form-horizontal pt-2" id="frm-login" role="form" method="post">
                            <!-- <div class="form-floating mb-3">
                                <input type="text" class="form-control form-input-bg" name="usuario" id="usuario" placeholder="Usuario" autocomplete="off">
                                <label for="usuario">Usuario</label>
                            </div> -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control form-control-lg form-input-bg style-login" style="padding-top: 1.625rem !important; padding-bottom: 0.625rem !important; border: 2px solid #ccc; border-radius: 20px;" name="usuario" id="usuario" placeholder="Usuario" autocomplete="off">
                                <label for="usuario"><i class="fas fa-user"></i> Usuario</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control form-control-lg form-input-bg style-login" style="padding-top: 1.625rem !important; padding-bottom: 0.625rem !important; border: 2px solid #ccc; border-radius: 20px;" name="password" id="password" placeholder="*****" autocomplete="off">
                                <label for="password"><i class="fas fa-lock"></i> Contraseña</label>
                            </div>
                            <!-- <div class="form-floating mb-3">
                                <input type="password" class="form-control form-input-bg" name="password" id="password" placeholder="*****" autocomplete="off">
                                <label for="password">Contrase&ntilde;a</label>
                            </div> -->
                            <div class="button-group px-2">
                                <button type="submit" class="btn btn-warning btn-block btn-lg px-4" style="border-radius: 25px;">Continuar</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4 mb-3 px-5">
                            <a class="btn btn-primary btn-lg btn-block" href="<?php echo URL; ?>multimozo" style="border-radius: 25px;">Multi Mozo</a>
                    </div>

                    <div class="text-center estilo-login-text" style="font-size: 12px;">Desarrollado por Tesegnor numero de contacto 930135988</div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.text-warning {
    color: #ea5b5d !important;
}
.btn-warning {
    color: #fff !important;
    background-color: #ea5b5d !important;
    border-color: #ea5b5d !important;
    box-shadow: 0 1px 0 rgb(255 255 255 / 15%);
}
.btn-warning:hover, .btn-warning.disabled:hover {
    background: #ea5b5d !important;
    color: #ffffff !important;
    -webkit-box-shadow: 0 14px 26px -12px rgb(234 91 93 / 42%), 0 4px 23px 0 rgb(0 0 0 / 12%), 0 8px 10px -5px rgb(234 91 93 / 20%);
    box-shadow: 0 14px 26px -12px rgb(234 91 93 / 42%), 0 4px 23px 0 rgb(0 0 0 / 12%), 0 8px 10px -5px rgb(234 91 93 / 20%);
    border: 1px solid #ea5b5d !important;
}
@media (max-width: 767px) {

    .auth-wrapper .auth-box-2 {
    padding: 15px 25px 0px 25px;
}
}


</style>