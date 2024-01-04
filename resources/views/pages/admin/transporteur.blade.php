@extends('layouts.admin.app')

@section('content')
    <style>
    .custom-modal-width .modal-dialog {
        max-width: 1000px; /* Modifiez ce pourcentage en fonction de vos besoins */
        width: 100%;
        margin: auto;
    }
    .table-responsive {
        overflow-x: auto;
    }

        button[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }    
        #modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #fff;
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            max-width: 600px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .cardd {
            background-color: white;
            text-align: center;
            padding: 10px;
            width: 400px;
            border: 1px solid black;
            border-radius: 10px;
            margin: 0 auto;
        }
        #open-modal-button {
            display: block;
            margin: 0 auto;
        }
    </style>
    <script>
    function returnToPreviousPage() {
    window.history.back(); // Revenir à la page précédente
    }
    </script>
    <button type="submit" onclick="returnToPreviousPage()">Retour</button><br> <br> <br>


    {{--<div class="row" >
        <div class="card">
            <button id="open-modal-button" class="btn btn-primary">Ajouter une entreprise de transporteur</button>
        </div>
    </div>--}}
    <div id="modal" class="modal">
        <div class="modal-content">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            
                <h5>  {{ session('success') }}</h5>
                    <span aria-hidden="true">&times;</span>
            
            </div>
            @endif
            <div class="modal-header">
                <h5>
                    Ajouter une entreprise de transporteur
                </h5>
                <button style="padding: 5px 5px;" type="button" id="close-modal-button" class="btn btn-secondary small-button" data-dismiss="modal">X</button>
            </div>    
            <div class="modal-body">
                <form action="{{ route('admin.ajouter-transporteur') }}" method="post">
                    @csrf
                    <label for="company_name">Nom de l'entreprise<span class="required">*</span></label>
                    <input type="text" name="company_name" required> <br>
                    
                    <label for="address">Adresse<span class="required">*</span></label>
                    <input type="text" name="address" required> <br>
                    
                    <label for="phone">Téléphone<span class="required">*</span></label>
                    <input type="text" name="phone" required> <br>

                    <label for="city">Ville<span class="required">*</span></label>
                    <input type="text" name="city" required> <br>
                    
                    <label for="email">Email<span class="required">*</span></label>
                    <input type="email" name="email" required> <br>
                    
                    <label for="ifu">Numéro IFU<span class="required">*</span></label>
                    <input type="text" name="ifu" required> <br>
                    
                    <label for="rccm">RCCM<span class="required">*</span></label>
                    <input type="text" name="rccm" required> <br>
                    
                    <!-- Champ caché pour stocker l'ID de l'utilisateur -->
                    <input type="hidden" name="user_id" value="{{ Session::get('userId') }}">
                    
                    <button type="submit mt-1" class="btn btn-primary mt-2">Ajouter Transporteur</button>
                </form>
            </div>
        </div> 
    </div>


    {{--    <form class="mb-3" id="assign-user-form" action="{{ route('admin.assigner-entreprise-user') }}" method="post">
            @csrf
            <div class="box-content">
                <div class="row mt-10">
                    <div class="col-md-6">
                        <h2>Assigner des entreprises aux utilisateurs</h2>
                        <div class="mb-3">
                            <label for="carrier_id">Assigner une entreprise transporteur :</label>
                            <select class="form-control" id="carrier_id" name="carrier_id">
                                <option value="">Sélectionner une entreprise transporteur</option>
                                @foreach ($carriers as $carrier)
                                    <option value="{{ $carrier->id }}">{{ $carrier->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit mb-1" class="btn btn-primary">Assigner une Entreprises aux Utilisateurs Sélectionnés</button>
                    </div>
                </div>
            </div>
        </form> --}}
        

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="border-bottom title-part-padding">
                        <h4 class="card-title mb-0">
                            <div class="row">
                                <div class="col-md-2 col-sm-12 top">
                                    <button
                                    type="button"
                                    id="btn-detail-offer"
                                    class="
                                        justify-content-center
                                        w-100
                                        btn btn-rounded btn-outline-success
                                        d-flex
                                        align-items-center
                                    "
                                    data-bs-toggle="modal" 
                                    data-bs-target="#detailModal"
                                
                                    >
                                        <i
                                            data-feather="plus-circle"
                                            class="feather-sm fill-white me-2"
                                        ></i>
                                        voir plus
                                    </button>
                                </div>
                                <div class="col-md-2 col-sm-12 top">
                                    <button
                                        type="button"
                                            id="btn-update-camion"
                                            class="
                                            justify-content-center
                                            w-100
                                            btn btn-rounded btn-outline-info
                                            d-flex
                                            align-items-center
                                            "
                                    >
                                        <i
                                            data-feather="edit"
                                            class="feather-sm fill-white me-2"
                                        ></i>
                                    Modifier
                                    </button>
                                </div>
                                <div class="col-md-2 col-sm-12 top">
                                    <button
                                        id="btn-delete-camion"
                                        type="button"
                                        class="
                                                justify-content-center
                                                w-100
                                                btn btn-rounded btn-outline-danger
                                                d-flex
                                                align-items-center
                                                "
                                    >
                                        <i
                                            data-feather="trash-2"
                                            class="feather-sm fill-white me-2"
                                        ></i>
                                        Supprimer
                                    </button>
                                </div>
                                <div class="col-md-3 col-sm-12 top">
                                    <button
                                        type="button"
                                            id="open-modal-button"
                                            class="
                                            justify-content-center
                                            w-100
                                            btn btn-rounded btn-outline-info
                                            d-flex
                                            align-items-center
                                            "
                                    >
                                        <i
                                            data-feather="plus-circle"
                                            class="feather-sm fill-white me-2"
                                        ></i>
                                    Ajout d'entreprise
                                    </button>
                                </div>
                            </div>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="user-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Entreprise</th>
                                        <th>Adresse</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Ville</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                    @foreach($carriers as $carrier)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="user-checkbox" name="selected_carrier[]" value="{{ $carrier->id }}">
                                            </td>
                                            <td>{{ $carrier->id }}</td>
                                            <td>{{ $carrier->company_name }}</td>
                                            <td>{{ $carrier->address }}</td>
                                            <td>{{ $carrier->email }}</td>
                                            <td>{{ $carrier->phone }}</td>
                                            <td>{{ $carrier->city }}</td>
                                        </tr>
                                    @endforeach
                                  {{--  @foreach($users->sortByDesc('id') as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->fk_carrier_id)
                                                    {{ $carriers->find($user->fk_carrier_id)->company_name }}
                                                @else
                                                    Aucune entreprise associée
                                                @endif
                                            </td>
                                            <td>
                                                <input type="checkbox" class="user-checkbox" name="selected_users[]" value="{{ $user->id }}">
                                                <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                                            </td>
                                        </tr>
                                    @endforeach 
                                    --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{--Modal pour voir les détials d'une entreprise--}}
        <div class="modal fade custom-modal-width" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Détails de l'Entreprise</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Ici seront affichées les informations de l'entreprise et les utilisateurs -->
                        <div id="companyInfo">
                            <!-- Structure pour afficher les détails de l'entreprise dans une table -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="border-bottom title-part-padding">
                                            <h4 class="card-title mb-0">
                                                <!-- Insérer ici les détails de l'entreprise -->
                                                <div class="row">
                                                    <span>Nom de l'entreprise: {{ $carrier->company_name }}</span>
                                                    <span>Adresse: {{ $carrier->address }}</span>
                                                    <!-- Autres détails de l'entreprise -->
                                                </div>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" id="user-table">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Entreprise</th>
                                                            <th>Adresse</th>
                                                            <th>Téléphone</th>
                                                            <th>Ville</th>
                                                            <th>Email</th>
                                                            <th>N° IFU</th>
                                                            <th>N° RCCM</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($carriers as $carrier)
                                                            <tr>
                                                                <td>{{ $carrier->id }}</td>
                                                                <td>{{ $carrier->company_name }}</td>
                                                                <td>{{ $carrier->address }}</td>
                                                                <td>{{ $carrier->phone }}</td>
                                                                <td>{{ $carrier->city }}</td>
                                                                <td>{{ $carrier->email }}</td>
                                                                <td>{{ $carrier->ifu }}</td>
                                                                <td>{{ $carrier->rccm }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="usersInfo">
                            <!-- Liste des utilisateurs -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="border-bottom title-part-padding">
                                            <h4 class="card-title mb-0">Utilisateurs de l'Entreprise</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Nom</th>
                                                            <th>Email</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Insérer ici la boucle pour afficher les utilisateurs -->
                                                        @foreach($users as $user)
                                                            <tr>
                                                                <td>{{ $user->id }}</td>
                                                                <td>{{ $user->name }}</td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>
                                                                    <!-- Bouton Assigner -->
                                                                    <button class="btn btn-primary btn-assign" data-user-id="{{ $user->id }}">Assigner</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <!-- Fin de la boucle des utilisateurs -->
                                                    </tbody>
                                                </table>
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
        

      {{--  <script>
            $(document).ready(function () {
                $('#btn-detail-offer').on('click', function () {
                    var selectedCarrier = $('input[name="selected_carrier[]"]:checked');
                    if (selectedCarrier.length === 1) {
                        var companyId = selectedCarrier.val();
        
                        // Ici, tu devrais faire une requête AJAX pour récupérer les informations de l'entreprise et les utilisateurs associés à cette entreprise
                        // Par exemple, en utilisant une route dans Laravel pour récupérer les données nécessaires
                        $.ajax({
                            url: '/get-company-details/' + companyId, // Remplace '/get-company-details/' par la route réelle de récupération des données de l'entreprise
                            type: 'GET',
                            success: function(response) {
                                $('#companyInfo').html(response.companyHtml); // Insère les détails de l'entreprise dans le modal
                                $('#usersInfo').html(response.usersHtml); // Insère les détails des utilisateurs associés dans le modal
                                $('#detailModal').modal('show'); // Affiche le modal
                            },
                            error: function(xhr) {
                                // Gère les erreurs si la requête AJAX échoue
                                console.error(xhr.responseText);
                            }
                        });
                    } else {
                        alert('Veuillez sélectionner une seule entreprise.');
                    }
                });
            });
        </script> --}}

        <script>
            $(document).ready(function () {
                $('#btn-detail-offer').on('click', function () {
                    var selectedCarriers = $('input[name="selected_carrier[]"]:checked');
                    if (selectedCarriers.length === 1) {
                        var companyId = selectedCarriers.val();
        
                        // Requête AJAX pour récupérer les informations de l'entreprise
                        $.ajax({
                            url: '/get-company-details/' + companyId, // Remplacez '/get-company-details/' par la route réelle de récupération des données de l'entreprise
                            type: 'GET',
                            success: function(response) {
                                $('#detailModal .modal-body').html(response); // Insère les détails de l'entreprise dans le modal
                                $('#detailModal').modal('show'); // Affiche le modal
                            },
                            error: function(xhr) {
                                // Gère les erreurs si la requête AJAX échoue
                                console.error(xhr.responseText);
                            }
                        });
                    } else if (selectedCarriers.length === 0 || selectedCarriers.length > 1) {
                        // Aucune entreprise sélectionnée ou plus d'une entreprise sélectionnée
                        var errorMessage = selectedCarriers.length === 0 ? 'Veuillez sélectionner une entreprise.' : 'Veuillez sélectionner une seule entreprise.';
                        alert(errorMessage);
        
                        // Redirection vers la page précédente après 3 secondes
                        setTimeout(function () {
                            history.back(); // Redirection vers la page précédente
                        }, 3000);
                    }
                });
            });
        </script>
        
        
        
        

   {{--     <div class="card ">
            <div class="row mt-10">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="user-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Entreprise</th>
                                    <th>Adresse</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Ville</th>
                                </tr>
                                </thead>
                            <tbody>
                                @foreach($carriers as $carrier)
                                    <tr>
                                        <td>{{ $carrier->id }}</td>
                                        <td>{{ $carrier->company_name }}</td>
                                        <td>{{ $carrier->address }}</td>
                                        <td>{{ $carrier->email }}</td>
                                        <td>{{ $carrier->phone }}</td>
                                        <td>{{ $carrier->city }}</td>
                                    </tr>
                                @endforeach
                              {{--  @foreach($users->sortByDesc('id') as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->fk_carrier_id)
                                                {{ $carriers->find($user->fk_carrier_id)->company_name }}
                                            @else
                                                Aucune entreprise associée
                                            @endif
                                        </td>
                                        <td>
                                            <input type="checkbox" class="user-checkbox" name="selected_users[]" value="{{ $user->id }}">
                                            <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                                        </td>
                                    </tr>
                                @endforeach 
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
        

        
    <style>
        .required {
            color: red;         /* couleur étoile */
            margin-left: 4px; /* Espacement entre le texte et l'étoile */
        }
    </style>

    <script>
        $(document).ready(function() {

            $('.alert').delay(2000).fadeOut(400, function() {
                $(this).alert('close');
            });
        });
    </script>
    <script>

        // Script pour gérer la soumission du formulaire d'assignation
        $(document).on('submit', '#assign-user-form', function(e) {
            e.preventDefault();

            var form = $(this);
            console.log(form)
            var url = form.attr('action');
            var formData = form.serialize();

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {
                    // Afficher un pop-up de succès avec SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500 // Temps d'affichage du popup en ms
                    }).then(() => {
                        // Réinitialiser les cases à cocher
                        $('.user-checkbox').prop('checked', false);
                        // Actualiser la page après la fermeture du popup
                        location.reload();
                    });
                },
                error: function(xhr) {
                    // Afficher un pop-up d'erreur en cas d'échec
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur s\'est produite. Veuillez réessayer.'
                    });
                }
            });
        });    

        document.getElementById('open-modal-button').addEventListener('click', function() {
            document.getElementById('modal').style.display = 'block';
        });

        document.getElementById('modal').addEventListener('click', function(event) {
            if (event.target === this) {
                this.style.display = 'none';
            }
        });

        document.getElementById('close-modal-button').addEventListener('click', function() {
            document.getElementById('modal').style.display = 'none';
        });

        document.getElementById('modal').addEventListener('click', function(event) {
            if (event.target === this) {
                this.style.display = 'none';
            }
        });

        $(document).ready(function () {
                    $("#close-modal-button").click(function () {
                        $("#edit-profile-modal").modal('hide');
                    });
                });
    </script>
@endsection
