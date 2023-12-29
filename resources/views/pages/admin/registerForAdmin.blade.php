@extends('layouts.admin.app')

@section('breadcumbs')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Formulaire Ajout Admin</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

@if(session('error_message'))
    <div class="alert alert-danger mt-3">
        {{ session('error_message') }}
            </div>
            <script>
            // JavaScript pour faire disparaître le message d'erreur après un délai
            window.addEventListener('DOMContentLoaded', function () {
                var errorMessage = document.getElementById('error-message');

             // Vérifiez si le message d'erreur est présent
                if (errorMessage) {
                setTimeout(function() {
                errorMessage.style.display = 'none';
                }, 6000); // Disparaître après 6 secondes (6000 millisecondes)
            }
        });
    </script>
@endif

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
    <div class="auth-box p-4 bg-white rounded">
    <div class="text-center">
                                <div class="text-center">
                                <p class="font-sm text-brand-2">Enregistrement </p>
                                <p class="font-sm text-muted mb-30">Créer un nouveau Admin</p>

                                <form class="login-register text-start mt-20" method="post" action="{{ route('registerUser') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="name">Nom <span class="text-danger">*</span></label>
                                            <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" required="" name="name" value="{{ old('name') }}" placeholder="Entrez votre nom">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="first_name">Prénoms <span class="text-danger">*</span></label>
                                            <input class="form-control @error('first_name') is-invalid @enderror" id="first_name" type="text" required="" name="first_name" value="{{ old('first_name') }}" placeholder="Entrez votre prénom">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="user_phone">Téléphone <span class="text-danger">*</span></label>
                                            <input class="form-control @error('user_phone') is-invalid @enderror" id="user_phone" type="text" required="" name="user_phone" value="{{ old('user_phone') }}" placeholder="Entrez votre téléphone">
                                            @error('user_phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                            <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" required="" name="email" value="{{ old('email') }}" placeholder="Entrez votre email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="username">Nom d'utilisateur<span class="text-danger">*</span></label>
                                            <input class="form-control @error('username') is-invalid @enderror" id="username" type="text" required="" name="username" value="{{ old('username') }}" placeholder="Entrez votre nom d'utilisateur">
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="password">Mot de passe <span class="text-danger">*</span></label>
                                            <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" required="" name="password" placeholder="************">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="password_confirmation">Confirmer le mot de passe <span class="text-danger">*</span></label>
                                            <input class="form-control" id="password_confirmation" type="password" required="" name="password_confirmation" placeholder="************">
                                        </div>
                                        <div class="form-group">
                                        <label class="">Rôle<span class="text-danger">*</span></label>
                                            <select class="form-select @error('role') is-invalid @enderror" aria-label="Default select example" name="role" required >
                                                <option selected value="choisir votre rôle" disabled>Choisir votre rôle</option>
                                                <option value="chargeur" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                                                
                                            </select>
                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-brand-1 hover-up w-100" type="submit" name="login"> S'inscrire</button>
                                        </div>
                                    </form>
                                </form>                                  
                            
                            </div>
                                    <div class="text-muted text-center">Avez-vous déjà un compte? <a href="">Connexion</a></div>

                            </div>
    </div>
</div>
<!-- -------------------------------------------------------------- -->
<!-- Login box.scss -->
<!-- -------------------------------------------------------------- -->
</div>

@endsection


@section('script')
    
@endsection
