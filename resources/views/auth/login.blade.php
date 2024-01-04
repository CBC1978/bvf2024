<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
        name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, material pro admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, material design, material dashboard bootstrap 5 dashboard template"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta
        name="description"  ty
        content="Bourse virtuelle de fret, gestion de fret, CBC, Conseil Burkinabè des Chargeurs"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>Bourse virtuelle de Fret</title>
    <link
        rel="canonical"
        href="https://www.wrappixel.com/templates/materialpro/"
    />
    <!-- Favicon icon -->
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="{{ asset('src/assets/images/favicon.ico') }}"
    />
    <!-- Custom CSS -->
    <link href="{{ asset('src/dist/css/style.min.css') }}" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
    <div
        class="
          auth-wrapper
          d-flex
          no-block
          justify-content-center
          align-items-center
        "
        style="
            background: url({{asset('src/assets/images/background/login-register.jpg')}})
            no-repeat center center;
            background-size: cover;
            "
    >
    <div class="auth-box p-4 bg-white rounded">
        <div id="loginform">
            <div class="logo">
                <h3 class="box-title mb-3">Se connecter</h3>
            </div>
            @if(Session::has('fail'))
                <div class="alert alert-danger"> {{ Session::get('fail') }}</div>
            @endif
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <form
                        class="form-horizontal mt-3 form-material"
                        id="loginform"
                        method="post"
                        action="{{ route('login') }}"
                    >
                        @csrf
                        <div class="form-group mb-3">
                            <div class="">
                                <input
                                    class="form-control @error('email') is-invalid @enderror"
                                    type="email" name="email" id="email"
                                    required
                                    placeholder="Email"
                                />
                            </div>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <div class="@error('password') is-invalid @enderror">
                                <input
                                    class="form-control"
                                    type="password" name="password" id="password"
                                    required
                                    placeholder="Mot de passe"
                                />
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <div class="ms-auto">
                                    <a
                                        href="javascript:void(0)"
                                        id="to-recover"
                                        class="link font-weight-medium"
                                    ><i class="fa fa-lock me-1"></i> Mot de passe oublié</a
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center mt-4 mb-3">
                            <div class="col-xs-12">
                                <button class=" btn btn-info d-block w-100 waves-effect waves-light " type="submit">
                                    Se connecter
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
                                <div class="social mb-3">
                                    <a
                                        href="javascript:void(0)"
                                        class="btn btn-facebook"
                                        data-bs-toggle="tooltip"
                                        title="Login with Facebook"
                                    >
                                        <i aria-hidden="true" class="fab fa-facebook-f"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0 mt-4">
                            <div class="col-sm-12 justify-content-center d-flex">
                                <p>
                                    Vous n'avez pas de compte?
                                    <a
                                        href="{{ route('register') }}"
                                        class="text-info font-weight-medium ms-1"
                                    >Inscrivez-vous</a
                                    >
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="recoverform">
            <div class="logo">
                <div class="mb-3">
                   <a
                       href="javascript:void(0)"
                       id="to-login"
                       class="link font-weight-medium"
                   ><i class="fa fa-arrow-left me-1"></i> Se connecter</a>
                    @if(Session::has('fail'))
                        <div class="alert alert-danger"> {{ Session::get('fail') }}</div>
                    @endif
                </div>
                <h3 class="font-weight-medium mb-3">Réinitialiser votre mot de passe</h3>
                <span class="text-muted"
                >Entrez votre email et suivez les instructions dans votre email!</span>

            </div>
            <div class="row mt-3 form-material">
                <!-- Form -->
                <form class="col-12" method="post" action="{{ route('updatePassword') }}">
                    @csrf
                    <!-- email -->
                    <div class="form-group row">
                        <div class="col-12">
                            <input
                                class="form-control @error('email1') is-invalid @enderror"
                                type="email" name="email1" id="email1"
                                required=""
                                placeholder="Entrez votre email"
                            />
                        </div>
                        @error('email1')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <input
                                class="form-control @error('pass1') is-invalid @enderror"
                                type="password" name="pass1" id="pass1"
                                placeholder="Confirmez votre mot de passe"
                            />
                        </div>
                        @error('pass1')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- pwd -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <button
                                class="btn d-block w-100 btn-primary text-uppercase"
                                type="submit"
                                name="action"
                            >
                                Réinitialiser
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- -------------------------------------------------------------- -->
<!-- Login box.scss -->
<!-- -------------------------------------------------------------- -->
</div>
<!-- -------------------------------------------------------------- -->
<!-- All Required js -->
<!-- -------------------------------------------------------------- -->
<script src="{{ asset('src/dist/libs/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('src/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- -------------------------------------------------------------- -->
<!-- This page plugin js -->
<!-- -------------------------------------------------------------- -->

<script>
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $("#to-recover").on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });

    $("#to-login").on("click", function () {
        $("#loginform").fadeIn();
        $("#recoverform").slideUp();
    });
    setTimeout(()=>{
        $("div.alert").remove();
    },4000)//4s
</script>
</body>
</html>
