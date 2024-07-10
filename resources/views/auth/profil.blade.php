@extends('layouts.app')

@section('head')

        <style>
            /* Style pour le conteneur principal */
            .container2 {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            /* Style pour l'en-tête du profil */
            h1 {
                font-size: 36px;
                color: #333;
                margin-bottom: 20px;
            }

            /* Style pour les informations du profil */
            ul {
                list-style-type: none;
                padding: 0;
            }

            li {
                font-size: 18px;
                color: #555;
                margin-bottom: 10px;
            }

            /* Style pour le bouton "Edit Profile" */
            #edit-profile-button {
                background-color: #007BFF;
                color: #fff;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 20px;
                display: inline-block;
                transition: background-color 0.3s ease;
            }

            #edit-profile-button:hover {
                background-color: #0056b3;
            }

            /* Style pour le formulaire de mise à jour du profil */
            #edit-profile-form {
                display: none;
                margin-top: 20px;
                text-align: left;
            }

            /* Style pour les champs de mon formulaire */
            input[type="text"],
            input[type="tel"],
            input[type="email"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            /* Style pour le bouton de mise à jour du profil */
            button[type="submit"] {
                background-color: #007BFF;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            button[type="submit"]:hover {
                background-color: #0056b3;
            }

            /* Style pour mon lien "Refresh" */
            a[href="#"] {
                text-decoration: none;
                color: #007BFF;
                margin-left: 10px;
                transition: color 0.3s ease;
            }

            a[href="#"]:hover {
                color: #0056b3;
            }

        </style>
@endsection
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(Session::has('fail'))
    <div class="alert alert-danger"> {{ Session::get('fail') }}</div>
@endif
<div class="container2">
    <h1>  {{ $user->username}} Profil</h1>

    <div class="profile-img">
        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt=""/>
    </div>

    <div class="affichage">
        <ul>
            <div class="col-md-15">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <h5 class="mb-0">Nom: </h5>
                            </div>
                            <div class="col-sm-5 text-secondary">
                                <h5>{{$user->name}}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-5">
                                <h5 class="mb-0">Prenom:</h5>
                            </div>
                            <div class="col-sm-5 text-secondary">
                                <h5> {{$user->first_name }}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-5">
                                <h5 class="mb-0">contact:</h5>
                            </div>
                            <div class="col-sm-5 text-secondary">
                                <h5>{{$user->user_phone }} </h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-5">
                                <h5 class="mb-0">Email:</h5>
                            </div>
                            <div class="col-sm-5 text-secondary">
                                <h5>{{$user->email }}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-5">
                                <h5 class="mb-0">code:</h5>
                            </div>
                            <div class="col-sm-5 text-secondary">
                                <h5> {{$user->code}}</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-5">
                                <h5 class="mb-0">Nom d'entreprise:</h5>
                            </div>
                            <div class="col-sm-5 text-secondary">
                                <h5>
                                    {{$user->company->company_name}}
                                </h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-5">
                                <h5 class="mb-0">Réception d'email de notification:</h5>
                            </div>
                            <div class="col-sm-5 text-secondary">
                                <h5>
                                    {{$user->verified}}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
    </div>

    <a id="edit-profile-button" href="#">Modifier</a>

    <div id="edit-profile-modal" style="display: none;" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info ">
                    <h5 class="modal-title text-white" style="text-align: center;">Modifier Votre profil</h5>
                    <button style="padding: 5px 5px;" type="button" id="close-modal-button" class="btn btn-secondary small-button" data-dismiss="modal">X</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('updateProfil') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        value="{{ old('name', $user->name) }}"
                                        required
                                        class="form-control"
                                    />
                                    <label
                                    ><i
                                            class="feather-sm text-dark fill-white me-2"
                                        ></i
                                        >Nom </label
                                    >
                                </div>
                                <div class="form-floating mb-3">
                                    <input
                                        type="text"
                                        name="first_name"
                                        value="{{ old('first_name', $user->first_name) }}"
                                        id="first_name"
                                        required
                                        class="form-control"

                                    />
                                    <label
                                    ><i
                                            class="feather-sm text-dark fill-white me-2"
                                        ></i
                                        >Prénoms<span class="text-danger">*</span></label
                                    >
                                </div>
                                <div class="form-floating mb-3">
                                    <input
                                        type="text"
                                        name="user_phone"
                                        value="{{ old('user_phone', $user->user_phone) }}"
                                        id="user_phone"
                                        required
                                        class="form-control"
                                    />
                                    <label
                                    ><i
                                            class="feather-sm text-dark fill-white me-2"
                                        ></i
                                        >Contact<span class="text-danger">*</span></label
                                    >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        value="{{ old('email', $user->email) }}"
                                        required
                                        class="form-control"
                                    />
                                    <label
                                    ><i
                                            class="feather-sm text-dark fill-white me-2"
                                        ></i
                                        >Email<span class="text-danger">*</span></label
                                    >
                                </div>
                                <div class="form-floating mb-3">
                                    <select
                                        name="verified"
                                        id="verified"
                                        class="form-control"
                                        style="width: 100%; height: 36px"
                                    >
                                        @if($user->email_verified == env('STATUS_VALID'))
                                            <option value="0">OUI</option>
                                            <option value="1" selected>NON</option>
                                        @else
                                            <option value="0" selected>OUI</option>
                                            <option value="1" >NON</option>
                                        @endif
                                    </select>
                                    <label
                                    ><i
                                            class="feather-sm text-dark fill-white me-2"
                                        ></i
                                        >Réception d'email</label
                                    >
                                </div>
                                <div class="form-floating mb-3">
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control"
                                    />
                                    <label
                                    ><i
                                            class="feather-sm text-dark fill-white me-2"
                                        ></i
                                        >Mot de passe</label
                                    >

                                </div>
                                <div class="form-floating mb-3">
                                    <input
                                        type="password"
                                        name="password_confirm"
                                        id="password_confirm"
                                        class="form-control"
                                    />
                                    <label
                                    ><i
                                            class="feather-sm text-dark fill-white me-2"
                                        ></i
                                        >Confirmer mot de passe</label
                                    >
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
                                        Modifier
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $("#edit-profile-button").click(function () {
                $("#edit-profile-modal").modal('show');
            });
            $("#close-modal-button").click(function () {
                $("#edit-profile-modal").modal('hide');
            });

            setTimeout(function (){
                $("div.alert").remove();
            },3000);
        });

    </script>
@endsection
