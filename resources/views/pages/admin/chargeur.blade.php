@extends('layouts.admin.app')

@section('content')
<style>
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

.card {
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
<div class="row" style="margin-bottom: -100px;">
    <div class="card">
        <button id="open-modal-button" class="btn btn-primary">Ajouter une entreprise expéditrice</button>
    </div>
</div>
<div id="modal" class="modal">
    <div class="modal-content">    
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">  
                <h5>
                    {{ session('success') }}
                </h5>
                <span aria-hidden="true">&times;</span> 
            </div>
            @endif
            <div class="modal-header">
                <h5>
                    Ajouter une entreprise expéditrice
                </h5>
                <button style="padding: 5px 5px;" type="button" id="close-modal-button" class="btn btn-secondary small-button" data-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
            <form action="admin.ajouter-expediteur" method="post">
                @csrf
                <label for="company_name">Nom de l'entreprise<span class="required">*</span></label>
                <input type="text" name="company_name" required>
                    
                <label for="address">Adresse<span class="required">*</span></label>
                <input type="text" name="address" required>
                    
                <label for="phone">Téléphone<span class="required">*</span></label>
                <input type="text" name="phone" required>

                <label for="city">Ville<span class="required">*</span></label>
                <input type="text" name="city" required>
                   
                <label for="email">Email<span class="required">*</span></label>
                <input type="email" name="email" required>
                    
                <label for="ifu">Numéro IFU<span class="required">*</span></label>
                <input type="text" name="ifu" required>
                    
                <label for="rccm">RCCM<span class="required">*</span></label>
                <input type="text" name="rccm" required>
                    
                <!-- Champ caché pour stocker l'ID de l'utilisateur -->
                <input type="hidden" name="user_id" value="{{ Session::get('userId') }}">
                 
                <button type="submit" class="btn btn-primary" >Ajouter Expéditeur</button>
            </form>
        </div>
    </div>
</div>


<div class="box-content" style="margin-top: 100px;">
    <div class="row mt-10">
        <div class="col-md-6">
            <h2>Assigner des entreprises aux utilisateurs</h2>
            <form id="assign-user-form" action="admin.assigner-entreprise-user" method="post">
                @csrf
                <div class="mb-3">
                    <label for="shipper_id">Assigner une entreprise expéditrice :</label>
                    <select class="form-control" id="shipper_id" name="shipper_id">
                        <option value="">Sélectionner une entreprise expéditrice</option>
                        @foreach ($shippers as $shipper)
                            <option value="{{ $shipper->id }}">{{ $shipper->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit mt-1" class="btn btn-primary">Assigner une Entreprises aux Utilisateurs Sélectionnés</button>
            </form>
        </div>
        <div class="row mt-10">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="user-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Entreprise</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users->sortByDesc('id') as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->fk_shipper_id)
                                            {{ $shippers->find($user->fk_shipper_id)->company_name }}
                                        @else
                                            Aucune entreprise associée
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" class="user-checkbox" name="selected_users[]" value="{{ $user->id }}">
                                        <input type="hidden"  id="user_ids[]" value="{{ $user->id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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
                    text: "Utilisateur affecté avec succès",
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
