<!DOCTYPE html>
<html lang="es">

<head>
    <title>COMPASSION</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Appestia App Landing Page Template by Phoenixcoded">
    <meta name="keywords"
        content="appestia, Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Phoenixcoded">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <!-- iconfont -->
    <link rel="stylesheet" type="text/css" href="/icon/icofont/css/icofont.css">

    <!-- simple line icon -->
    <link rel="stylesheet" type="text/css" href="/icon/simple-line-icons/css/simple-line-icons.css">

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="/plugins/bootstrap/css/bootstrap.min.css">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="/css/main.css">

    <!-- Responsive.css-->
    <link rel="stylesheet" type="text/css" href="/css/responsive.css">

    <!--color css-->
    <link rel="stylesheet" type="text/css" href="/css/color/color-1.min.css" id="color" />

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.min.css" />

    <!-- App CSS -->
    <link rel="stylesheet" href="/css/app.css">

    <!-- Alertify -->
    <link rel="stylesheet" href="/css/alertify.min.css">

    <!-- MultiSelect -->
    <link rel="stylesheet" href="/css/vue-multiselect.min.css">
</head>

<body>
    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="login-card card-block">
                        <form class="md-float-material" method="POST" action="{{ route('login') }}">
                            @csrf
                            <h3 class="text-center txt-primary">
                                COMPASSION
                            </h3>
                            <div class="md-input-wrapper">
                                <input type="text" type="text"
                                    class="md-form-control" name="usuario"
                                    value="{{ old('usuario') }}" required autocomplete="usuario" autofocus>
                                <label>Usuario</label>
                            </div>
                            <div class="md-input-wrapper">
                                <input id="password" type="password"
                                    class="md-form-control" name="password"
                                    required autocomplete="current-password">
                                <label>Contraseña</label>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="rkmd-checkbox checkbox-rotate checkbox-ripple m-b-25">
                                        <label class="input-checkbox checkbox-primary">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="checkbox"></span>
                                        </label>
                                        <div class="captions">Recuerdame</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-10 offset-xs-1">
                                    <button type="submit"
                                        class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">INGRESAR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="/plugins/jquery/dist/jquery.min.js"></script>
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/plugins/tether/dist/js/tether.min.js"></script>

    <!-- Required Fremwork -->
    <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- waves effects.js -->
    <script src="/plugins/Waves/waves.min.js"></script>

    <!-- Scrollbar JS-->
    <script src="/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="/plugins/jquery.nicescroll/jquery.nicescroll.min.js"></script>

    <!--classic JS-->
    <script src="/plugins/classie/classie.js"></script>

    <!-- notification -->
    <script src="/plugins/notification/js/bootstrap-growl.min.js"></script>

    <!-- custom js -->
    <script type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="/pages/elements.js"></script>
    <script src="/js/menu.js"></script>
</body>

</html>