@extends('layouts.admin.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin-profil</title>
    <script>
      function returnToPreviousPage() {
      window.history.back(); // Revenir à la page précédente
    }
    </script>
</head>
<body>      
    <button type="submit" onclick="returnToPreviousPage()">Retour</button>

    <div class="container2">
        <h1>  {{ $user->username}} Profile</h1>

        <div class="profile-img">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" width="100" height="100"/>
                        <div class="file btn btn-lg btn-primary">
                            Changer de Photo
                        <input type="file" name="file"/>
                        </div>
                    </div>

        @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
        @endif
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
                        <h5 class="mb-0">Nom d'utilisateur:</h5>
                        </div>
                        <div class="col-sm-5 text-secondary">
                         <h5>{{ $user->username}}</h5>
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
                            @if ($user->fk_shipper_id) 
                            {{ $user->shipper->company_name }} 
                            @else 
                            Aucune entreprise associée
                            @endif
                         </h5> 
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </ul>
     {{--   <a href="{{ route('admin.profile.affichage') }}"><button type="submit">Refresh</button></a> --}}
        </div>

        <a id="edit-profile-button" href="#">Modifier</a>
        <div id="edit-profile-modal" style="display: none;" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="text-align: center;">Modifier Votre profil</h5>
                        <button style="padding: 5px 5px;" type="button" id="close-modal-button" class="btn btn-secondary small-button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.profile.update') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="first_name">Prénom</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                            </div>
                            <div class="form-group">
                                <label for="username">Nom d'utilisateur</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}">
                            </div>
                            <div class="form-group">
                                <label for="user_phone">Contact</label>
                                <input type="tel" class="form-control" id="user_phone" name="user_phone" value="{{ old('user_phone', $user->user_phone) }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="form-group">
                                <label for="company_name">Nom d'entreprise</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $user->carrier ? $user->carrier->company_name : '') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            $(document).ready(function () {
                $("#edit-profile-button").click(function () {
                    $("#edit-profile-modal").modal('show');
                });
                $("#close-modal-button").click(function () {
                    $("#edit-profile-modal").modal('hide');
                });
            });            
        </script>
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

</body>
</html>
@endsection