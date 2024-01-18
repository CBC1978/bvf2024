<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
        name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, material pro admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, material design, material dashboard bootstrap 5 dashboard template"
    />
    <meta
        name="description"
        content="MaterialPro is powerful and clean admin dashboard template, inpired from Google's Material Design"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>MaterialPro Admin Template by WrapPixel</title>
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
    <!-- This page CSS -->


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
<div id="main-wrapper">
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="border-bottom title-part-padding">
                            <h4 class="card-title mb-0">Etapes d'inscription à la bourse virtuelle de fret</h4>
                        </div>
                        <div class="card-body wizard-content">
                            <h6 class="card-subtitle mb-3">
                                Renseigner vos informations personnelles
                            </h6>
                            <form action="#" class="validation-wizard wizard-circle mt-5">
                                <!-- Step 1 -->
                                <h6>Profil</h6>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6">
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
                                                    class="form-control required"
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
                                                    class="form-control required"
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
                                                    class="form-control required @error('email') is-invalid @enderror"
                                                />
                                                <label for="email"
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    > Email<span class="text-danger">*</span></label
                                                >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="text"
                                                    name="username"
                                                    id="username"
                                                    class="form-control required"
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
                                                    class="form-control required"
                                                />
                                                <label for="name"
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    > Mot de passe<span class="text-danger">*</span></label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="password"
                                                    name="password_confirmation"
                                                    id="password_confirmation"
                                                    class="form-control required"
                                                />
                                                <label for="name"
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    > Confirmer votre de passe<span class="text-danger">*</span></label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select
                                                    class="form-select"
                                                    name="role"
                                                    id="role"
                                                    class="form-control required"
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
                                        </div>
                                    </div>
                                </section>
                                <!-- Step 2 -->
                                <h6>Entreprise</h6>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="jobTitle2">Company Name :</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="jobTitle2"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="shortDescription3"
                                                >Short Description :</label
                                                >
                                                <textarea
                                                    name="shortDescription"
                                                    id="shortDescription3"
                                                    rows="6"
                                                    class="form-control"
                                                ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer text-center">
            All Rights Reserved by Materialpro admin.
        </footer>
    </div>
</div>

<script src="{{asset('src/dist/libs/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('src/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!-- apps -->
<script src="{{asset('src/dist/js/app.min.js')}}"></script>
<script src="{{asset('src/dist/js/app.init.mini-sidebar.js')}}"></script>
<script src="{{asset('src/dist/js/app-style-switcher.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('src/dist/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.js')}}"></script>
<script src="{{asset('src/dist/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('src/dist/js/waves.js')}}"></script>
<!--Menu sidebar -->
<!--Custom JavaScript -->
<script src="{{asset('src/dist/js/feather.min.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('src/dist/js/custom.min.js')}}"></script>
<script src="{{asset('src/dist/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>
<script src="{{asset('src/dist/libs/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script>
    var form = $(".validation-wizard").show();

    $(".validation-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Submit",
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            if(currentIndex === 1){
                alert('test');
            }
            return (
                currentIndex > newIndex ||
                (!(1 === newIndex && Number($("#age-2").val()) < 18) &&
                    (currentIndex < newIndex &&
                    (form.find(".body:eq(" + newIndex + ") label.error").remove(),
                        form
                            .find(".body:eq(" + newIndex + ") .error")
                            .removeClass("error")),
                        (form.validate().settings.ignore = ":disabled,:hidden"),
                        form.valid()))
            );
        },
        onFinishing: function (event, currentIndex) {
            // var data =  new FormData(this);

            var first = $('#wfirstName2').val();
            console.log(first);
            return (form.validate().settings.ignore = ":disabled"), form.valid();
        },
        onFinished: function (event, currentIndex) {
            swal(
                "Form Submitted!",
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed."
            );
        },
    }),
        $(".validation-wizard").validate({
            ignore: "input[type=hidden]",
            errorClass: "text-danger",
            successClass: "text-success",
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function (element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            rules: {
                email: {
                    email: !0,
                },
            },
        });
</script>
</body>
</html>
