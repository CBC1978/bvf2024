<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
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
                                                        <td>{{ $carrier->rrcm }}</td>
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
