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
    <link rel="stylesheet" href="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">

    <!-- -------------------------------------------------------------- -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- -------------------------------------------------------------- -->
    <div class="preloader">
        <svg
            class="tea lds-ripple"
            width="37"
            height="48"
            viewbox="0 0 37 48"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z"
                stroke="#1e88e5"
                stroke-width="2"
            ></path>
            <path
                d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34"
                stroke="#1e88e5"
                stroke-width="2"
            ></path>
            <path
                id="teabag"
                fill="#1e88e5"
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"
            ></path>
            <path
                id="steamL"
                d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke="#1e88e5"
            ></path>
            <path
                id="steamR"
                d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13"
                stroke="#1e88e5"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            ></path>
        </svg>
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- -------------------------------------------------------------- -->
    <!-- -------------------------------------------------------------- -->
    <!-- Login box.scss -->
    <!-- -------------------------------------------------------------- -->
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
    <div class="card col-8">
    <div class="card-body">
    <div class="text-center">
        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
        @endif
            <p class="font-sm text-brand-2">Inscription </p>
            <p class="font-sm text-muted mb-30">Créer un compte facilement et rapidement</p>
                <form class="login-register text-start mt-20" method="post" action="{{ route('registerUser') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-xs-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    required
                                    class="form-control"
                                    placeholder="Nom"
                                />
                                <label for="name"
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    > Nom<span class="text-danger">*</span></label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="first_name"
                                    id="first_name"
                                    required
                                    class="form-control"
                                    placeholder="Prénom"
                                />
                                <label for="first_name"
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    > Prénom(s)<span class="text-danger">*</span></label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="user_phone"
                                    id="user_phone"
                                    required
                                    class="form-control"
                                    placeholder="Téléphone"
                                />
                                <label for="user_phone"
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    > Téléphone<span class="text-danger">*</span></label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    required
                                    class="form-control @error('email') is-invalid @enderror"

                                    placeholder="Email"
                                />
                                <label for="email"
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    > Email<span class="text-danger">*</span></label
                                >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <select
                                    class="form-select"
                                    name="type_company"
                                    id="type_company"
                                    class="form-control"
                                    required
                                >
                                    <option selected value="Personne Physique ou Morale" disabled>Choisir votre type</option>
                                    <option value="1" {{ old('type_company') == '1' ? 'selected' : '' }}>Personne Physique</option>
                                    <option value="0" {{ old('type_company') == '0' ? 'selected' : '' }}>Personne Morale</option>
                                </select>
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Type entreprise<span class="text-danger">*</span></label
                                >
                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-12">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="username"
                                    id="username"
                                    required
                                    class="form-control"
                                    placeholder="Nom d'utilisateur"
                                />
                                <label for="username"
                                ><i
                                    class="feather-sm text-dark fill-white me-2"
                                ></i
                                    > Nom d'utilisateur<span class="text-danger">*</span></label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    required
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Mot de passe"
                                />
                                <label for="password"
                                ><i
                                    class="feather-sm text-dark fill-white me-2"
                                ></i
                                    > Mot de passe<span class="text-danger">*</span></label
                                >
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    required
                                    class="form-control"
                                    placeholder="Confirmer le mot de passe"
                                />
                                <label for="password_confirmation"
                                ><i
                                    class="feather-sm text-dark fill-white me-2"
                                ></i
                                    > Confirmer mot de passe<span class="text-danger">*</span></label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <select
                                    class="form-select"
                                    name="role"
                                    id="role"
                                    class="form-control"
                                    required
                                    placeholder="Rôle"
                                >
                                        <option selected value="choisir votre rôle" disabled>Choisir votre rôle</option>
                                        <option value="chargeur" {{ old('role') == 'chargeur' ? 'selected' : '' }}>Chargeur</option>
                                        <option value="transporteur" {{ old('role') == 'transporteur' ? 'selected' : '' }}>Transporteur</option>
                                </select>
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Rôle<span class="text-danger">*</span></label
                                >
                        </div>
                        <div class="form-floating mb-3">
                            <select
                                class="form-select "
                                name="id_company"
                                id="id_company"
                                required
                                class="form-control"
                                placeholder="id_company"
                            >
                            </select>
                            <label
                            ><i
                                    class="feather-sm text-dark fill-white me-2"
                                ></i
                                >Entreprise<span class="text-danger">*</span></label
                            >
                        </div>
                    </div>
                </div>
                <div class="row" id="type_entreprise">
                    <div class="col-md-6 col-xs-12 col-sm-12">
                        <div class="form-floating mb-3">
                            <input
                                type="text"
                                name="company_name"
                                id="company_name"
                                class="form-control"
                                placeholder=""
                            />
                            <label for="company_name"
                            ><i
                                    class="feather-sm text-dark fill-white me-2"
                                ></i
                                > Nom ou raison sociale<span class="text-danger">*</span></label
                            >
                        </div>
                        <div class="form-floating mb-3" >
                            <select
                                class="form-select"
                                name="ville_company"
                                id="ville_company"
                                class="form-control"
                                placeholder="ville_company"
                            >
                                <option selected value="choisir votre ville" disabled>Choisir une ville</option>
                                @foreach($villes as $ville)
                                    <option value="{{$ville->id}}" >{{$ville->libelle}}</option>
                                @endforeach
                            </select>
                            <label for="ville_company"
                            ><i
                                    class="feather-sm text-dark fill-white me-2"
                                ></i
                                >Ville</label
                            >
                        </div>
                        <div class="form_pm">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="phone_company"
                                    id="phone_company"
                                    class="form-control"
                                    placeholder=""
                                />
                                <label for="phone_company"
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    > Téléphone</label
                                >
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-12">
                        <div class="form-floating mb-3">
                            <input
                                type="text"
                                name="adresse"
                                id="adresse"
                                class="form-control"
                                placeholder=""
                            />
                            <label for="adresse"
                            ><i
                                    class="feather-sm text-dark fill-white me-2"
                                ></i
                                > Adresse</label
                            >
                        </div>
                        <div class="form_pm">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="ifu"
                                    id="ifu"
                                    class="form-control"
                                    placeholder=""
                                />
                                <label for="ifu"
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    > Numéro IFU</label
                                >
                            </div>
                            <div class="form-floating mb-3">
                            <input
                                type="text"
                                name="rccm"
                                id="rccm"
                                class="form-control"
                                placeholder=""
                            />
                            <label for="rccm"
                            ><i
                                    class="feather-sm text-dark fill-white me-2"
                                ></i
                                > Numéro RCCM</label
                            >
                        </div>
                        </div>
                    </div>
                </div>
                <div class="d-md-flex align-items-center">
                    <div class="mt-3 mt-md-0 ms-auto">
                        <button
                            type="submit"
                            class="
                                    btn btn-info
                                    font-weight-medium
                                    rounded-pill
                                    px-4
                                "
                        >
                            <div class="d-flex align-items-center">
                                <i
                                    data-feather="send"
                                    class="feather-sm fill-white me-2"
                                ></i>
                                S'inscrire
                            </div>
                        </button>

                    </div>
                </div>

                </form>
                <div class="text-muted text-center">Avez-vous déjà un compte? <a href="{{route('index')}}">Connexion</a></div>
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
<script src="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<!-- -------------------------------------------------------------- -->
<!-- This page plugin js -->
<!-- -------------------------------------------------------------- -->

<script>
    $(document).ready(function (){
        $('#type_entreprise').hide();

        $('#id_company').change(function (){
            var obj= $( "#id_company option:selected" ).val();
            if(obj == 0)
                $('#type_entreprise').show();
            else
                $('#type_entreprise').hide();
        });

        $("#type_company").change(function (){
            $('#type_entreprise').hide();
            var obj_type= $( "#type_company option:selected" ).val();
            var obj_role= $( "#role option:selected" ).val();
            if(obj_role == 'transporteur'){
                if(obj_type == '1'){
                    fetch ('/entreprise/1/1')
                        .then(response => response.json())
                        .then(response =>{
                            $('.form_pm').hide();
                            $( "#id_company option").each(function (){
                                $(this).remove();
                            });
                            var firstRow = `
                              <option selected value="choisir votre rôle" disabled>Choisir votre entreprise</option>
                               <option value="0" >Créer</option>
                            `;
                            $('#id_company').append(firstRow);

                               response.forEach(item=>{
                                   var newRow = `
                                       <option value="${item.id}" >${item.company_name}</option>
                                   `;
                                   $('#id_company').append(newRow);
                               });
                        });

                }else if(obj_type == '0'){
                    fetch ('/entreprise/2/1')
                        .then(response => response.json())
                        .then(response =>{
                            $('.form_pm').show();
                            $( "#id_company option").each(function (){
                                $(this).remove();
                            });
                            var firstRow = `
                              <option selected value="choisir votre rôle" disabled>Choisir votre entreprise</option>
                               <option value="0" >Créer</option>
                            `;
                            $('#id_company').append(firstRow);

                            response.forEach(item=>{
                                var newRow = `
                                       <option value="${item.id}" >${item.company_name}</option>
                                   `;
                                $('#id_company').append(newRow);
                            });
                        });
                }
            }else if(obj_role == 'chargeur'){
                if(obj_type == '1'){
                    fetch ('/entreprise/1/2')
                        .then(response => response.json())
                        .then(response =>{
                            $('.form_pm').hide();
                            $( "#id_company option").each(function (){
                                $(this).remove();
                            });
                            var firstRow = `
                              <option selected value="choisir votre rôle" disabled>Choisir votre entreprise</option>
                               <option value="0" >Créer</option>
                            `;
                            $('#id_company').append(firstRow);

                            response.forEach(item=>{
                                var newRow = `
                                       <option value="${item.id}" >${item.company_name}</option>
                                   `;
                                $('#id_company').append(newRow);
                            });
                        });

                }else if(obj_type == '0'){
                    fetch ('/entreprise/2/2')
                        .then(response => response.json())
                        .then(response =>{
                            $('.form_pm').show();
                            $( "#id_company option").each(function (){
                                $(this).remove();
                            });
                            var firstRow = `
                              <option selected value="choisir votre rôle" disabled>Choisir votre entreprise</option>
                               <option value="0" >Créer</option>
                            `;
                            $('#id_company').append(firstRow);

                            response.forEach(item=>{
                                var newRow = `
                                       <option value="${item.id}" >${item.company_name}</option>
                                   `;
                                $('#id_company').append(newRow);
                            });
                        });
                }
            }else{
                Swal.fire({
                    title: 'Erreur',
                    text: 'Aucun rôle sélectionné',
                    icon: 'error',
                });
            }
        })

        $("#role").change(function (){
            $('#type_entreprise').hide();
            var obj_type= $( "#type_company option:selected" ).val();
            var obj_role= $( "#role option:selected" ).val();
            if(obj_type == '1'){
                if(obj_role == 'transporteur'){
                    fetch ('/entreprise/1/1')
                        .then(response => response.json())
                        .then(response =>{
                            $('.form_pm').hide();
                            $( "#id_company option").each(function (){
                                $(this).remove();
                            });
                            var firstRow = `
                              <option selected value="choisir votre rôle" disabled>Choisir votre entreprise</option>
                               <option value="0" >Créer</option>
                            `;
                            $('#id_company').append(firstRow);

                               response.forEach(item=>{
                                   var newRow = `
                                       <option value="${item.id}" >${item.company_name}</option>
                                   `;
                                   $('#id_company').append(newRow);
                               });
                        });

                }else if(obj_role == 'chargeur'){
                    fetch ('/entreprise/1/2')
                        .then(response => response.json())
                        .then(response =>{
                            $('.form_pm').hide();
                            $( "#id_company option").each(function (){
                                $(this).remove();
                            });
                            var firstRow = `
                              <option selected value="choisir votre rôle" disabled>Choisir votre entreprise</option>
                               <option value="0" >Créer</option>
                            `;
                            $('#id_company').append(firstRow);

                            response.forEach(item=>{
                                var newRow = `
                                       <option value="${item.id}" >${item.company_name}</option>
                                   `;
                                $('#id_company').append(newRow);
                            });
                        });
                }
            }else if(obj_type == '0'){
                if(obj_role == 'transporteur'){
                    fetch ('/entreprise/2/1')
                        .then(response => response.json())
                        .then(response =>{
                            $('.form_pm').show();
                            $( "#id_company option").each(function (){
                                $(this).remove();
                            });
                            var firstRow = `
                              <option selected value="choisir votre rôle" disabled>Choisir votre entreprise</option>
                               <option value="1" >Créer</option>
                            `;
                            $('#id_company').append(firstRow);

                            response.forEach(item=>{
                                var newRow = `
                                       <option value="${item.id}" >${item.company_name}</option>
                                   `;
                                $('#id_company').append(newRow);
                            });
                        });

                }else if(obj_role == 'chargeur'){
                    fetch ('/entreprise/2/2')
                        .then(response => response.json())
                        .then(response =>{

                            $('.form_pm').show();
                            $( "#id_company option").each(function (){
                                $(this).remove();
                            });
                            var firstRow = `
                              <option selected value="choisir votre rôle" disabled>Choisir votre entreprise</option>
                               <option value="1" >Créer</option>
                            `;
                            $('#id_company').append(firstRow);

                            response.forEach(item=>{
                                var newRow = `
                                       <option value="${item.id}" >${item.company_name}</option>
                                   `;
                                $('#id_company').append(newRow);
                            });
                        });
                }
            }else{
                // Swal.fire({
                //     title: 'Erreur',
                //     text: 'Aucun type sélectionné',
                //     icon: 'error',
                // });
            }
        })

    });
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
