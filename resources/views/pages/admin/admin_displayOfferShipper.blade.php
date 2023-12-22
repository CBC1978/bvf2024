@extends('layouts.admin.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('src/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <style>
        @media screen and  (min-width: 100px) and  (max-width: 768px){
            .top{
                margin-top:5px;
            }
        }
    </style>
@endsection

@section('breadcumbs')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">OFFRES</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Offres</a>
                </li>
                <li class="breadcrumb-item active">Offres de Chargeurs</li>
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

<div class="container1">
        <table class="table table-responsive" id="requestTable">
        <h3>La liste des annonces des Chargeurs</h3>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Entreprise</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>nombre d'offre(s)</th>
                    <!--th>status</th-->
                    <th>Détail sur l'offre</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chargeurAnnonces as $annonce)
                    <tr>
                        <td>{{ $annonce->id }}</td>
                        <td>
                            @if ($annonce->fk_shipper_id)
                                {{ $annonce->shipper->company_name }}
                            @else
                                Aucune entreprise associée
                            @endif
                        </td>
                        <td>Chargeur</td>
                        <td>{{ $annonce->description }}</td>
                        <td>
                            @if($annonce->transportOffer->count() > 0)
                                {{ $annonce->transportOffer->count() }} Offre(s)
                            @else
                                Aucune offre
                            @endif
                        </td>
                        <!--td>
                            @if ($annonce->status == 1) 
                                Actif
                            @else
                                Desactivé
                            @endif
                        </td-->
                        <td>
                            <div class="annonce">
                                <div class="annonceContent" style="display:none;">
                                    <!-- Détails pour cette annonce spécifique -->
                                    @if($annonce->transportOffer->count() > 0)
                                        <ul>
                                            @foreach($annonce->transportOffer as $offre)
                                                <li>
                                                    <p>Détails de l'Offre</p>
                                                    <p>Description de l'annonce : {{ $annonce->description }}</p>
                                                    <p>Date d'expiration : {{ $annonce->limit_date }}</p>
                                                    <strong>transporteur :</strong> {{ $offre->carrier->company_name}}</br>
                                                    <strong>Prix :</strong> {{ $offre->price }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>Aucune offre de transit pour cette annonce.</p>
                                    @endif
                                </div>

                                <button class="voir-offre small" data-offre-id="{{ $annonce->id }}" onclick="toggleContent(this)">Voir plus...</button>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  
@endsection

@section('script')

<script>

        function toggleContent(bouton) {
            var contenu = bouton.parentNode.querySelector(".annonceContent");
            if (contenu.style.display === "none") {
                contenu.style.display = "block";
            } else {
                contenu.style.display = "none";
            }
        }
        
        new DataTable('#requestTable', {
            responsive:true,
            "ordering": false,
            language:{
                "decimal":        "",
                "emptyTable":     "Pas de données disponible",
                "info":           "Affichage _START_ sur _END_ de _TOTAL_ éléments",
                "infoEmpty":      "Affichage 0 sur 0 de 0 entries",
                "infoFiltered":   "(filtrage de _MAX_ total éléments)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Afficher _MENU_ éléments",
                "loadingRecords": "Chargement...",
                "processing":     "",
                "search":         "Recherche:",
                "zeroRecords":    "Pas de correspondance trouvé",
                "paginate": {
                    "first":      "Premier",
                    "last":       "Dernier",
                    "next":       "Suivant",
                    "previous":   "Précédent"
                },
            }
        } );
 
        // Afficher/masquer les champs de recherche et de filtrage
        $('#toggle-fields').click(function() {
            $('#search-group').toggle();
        });

        // Récupérer l'élément d'entrée de recherche
        const searchInput = document.getElementById('search');

        // Ajouter un gestionnaire d'événement pour la saisie dans l'entrée de recherche
        searchInput.addEventListener('input', function () {
            const searchID = parseInt(searchInput.value); // ID saisi en tant que nombre
            
            // Parcourir toutes les lignes du tableau et les cacher ou afficher en fonction de la recherche
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const idCell = row.querySelector('td:first-child'); // Cellule de l'ID
                const rowID = parseInt(idCell.textContent); // ID de la ligne en tant que nombre
                
                // Vérifier si l'ID de la ligne correspond à l'ID saisi
                if (isNaN(searchID) || rowID === searchID) {
                    row.style.display = ''; // Afficher la ligne
                } else {
                    row.style.display = 'none'; // Cacher la ligne
                }
            });
        });

    </script>

    <script>
            $(document).ready(function (){
                setTimeout(function(){
                    $("div.alert").remove();
                }, 3000 ); //3s

            });
        </script>
  
@endsection

@section('style')


@endsection
