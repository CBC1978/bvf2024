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
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <div class="d-flex mt-2 justify-content-end">
                <div class="d-flex me-3 ms-2">
                    <div class="chart-text me-2">
                        <h6 class="mb-0"><small>THIS MONTH</small></h6>
                        <h4 class="mt-0 text-info">$58,356</h4>
                    </div>
                    <div class="spark-chart">
                        <div id="monthchart"></div>
                    </div>
                </div>
                <div class="d-flex ms-2">
                    <div class="chart-text me-2">
                        <h6 class="mb-0"><small>LAST MONTH</small></h6>
                        <h4 class="mt-0 text-primary">$48,356</h4>
                    </div>
                    <div class="spark-chart">
                        <div id="lastmonthchart"></div>
                    </div>
                </div>
            </div>
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

<div class="box-content">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-box">
                <div class="container">
                    <div class="box-padding">
                      <div class="login-register">
                        <div class="row login-register-cover">
                          <div class="col-lg-6 col-md-4 col-sm-12 mx-auto">
                            <div class="form-login-cover">
                              <div class="text-center">
                                <p class="font-sm text-brand-2">Enregistrement </p>
                                <p class="font-sm text-muted mb-30">Créer un nouveau Admin</p>

                                <form action="{{ route('registerForAdmin') }}" method="post">
                                    @csrf
                                    @method('post')
                                    <div class="form-group">
                                        <label for="name">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="first_name">Prénom</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Nom d'utilisateur</label>
                                        <input type="text" class="form-control" id="username" name="username" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="user_phone">Téléphone</label>
                                        <input type="tel" class="form-control" id="user_phone" name="user_phone" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="">
                                    </div>
                                    <!-- ... Autres champs ... -->
                                    <div class="form-group">
                                        <label for="role">Rôle</label>
                                        <select class="form-control" id="role" name="role">
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <!-- ... Autres champs ... -->

                                    <div class="form-group">
                                        <label for="password">Mot De Pass</label>
                                        <input type="password" class="form-control" id="password" name="password" value="">
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-brand-1 hover-up w-100" type="submit" name="login"> S'inscrire</button>
                                    </div> 
                                </form>                                  
                            
                            </div>
                        </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


@section('script')
    
@endsection
