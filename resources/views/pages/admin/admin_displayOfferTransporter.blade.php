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
                <li class="breadcrumb-item active">Offres de Transporteurs</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

        <div class="container1 mt-2">
        <table class="table table-responsive" id="requestTable">
        <h3>La liste des annonces des Transporteurs</h3>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Entreprise</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Nombre D'offre(s)</th>
                    <!--th>status</th-->
                    <th>Détail sur l'offre</th>
                </tr>
            </thead>
            <tbody>
               
                @foreach($transporteurAnnonces as $annonce)
                    <tr>
                        <td>{{ $annonce->id }}</td>
                        <td>
                            @if ($annonce->fk_carrier_id)
                                {{ $annonce->carrier->company_name }}
                            @else
                                Aucune entreprise associée
                            @endif
                        </td>
                        <td>Transporteur</td>
                        <td>{{ $annonce->description }}</td>
                        <td>
                        
                            @if($annonce->freightOffer->count() > 0)
                                {{ $annonce->freightOffer->count() }} Offre(s)
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
                                    @if($annonce->freightOffer->count() > 0)
                                        <ul>
                                            @foreach($annonce->freightOffer as $offre)
                                                <li>
                                                    <p>Details Offre</p>
                                                    <p>Description de l'annonce : {{ $annonce->description }}</p>
                                                    <p>Date d'expiration : {{ $annonce->limit_date }}</p>
                                                    <strong>Shipper :</strong> {{ $offre->shipper->company_name}}</br>
                                                    <strong>Prix :</strong> {{ $offre->price }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>Aucune offre de transport pour cette annonce.</p>
                                    @endif
                                </div>

                                <button class="voir-offre small" data-offre-id="{{ $annonce->id }}" onclick="toggleContent(this)">Voir plus...</button>
                            </div>

                            <style>
                                .small {
                                    font-size: 10px; /* Taille de la police */
                                    padding: 5px 5px ; /* Espacement intérieur du bouton */
                                }
                            </style>

                                
                            <script>
                            function toggleContent(bouton) {
                                var contenu = bouton.parentNode.querySelector(".annonceContent");
                                if (contenu.style.display === "none") {
                                    contenu.style.display = "block";
                                } else {
                                    contenu.style.display = "none";
                                }
                            }
                            </script>
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

            function toggleContent(bouton) {
                var contenu = bouton.parentNode.querySelector(".annonceContent");
                if (contenu.style.display === "none") {
                    contenu.style.display = "block";
                } else {
                    contenu.style.display = "none";
                        }
            }

            $(document).ready(function (){
                setTimeout(function(){
                    $("div.alert").remove();
                }, 3000 ); //3s

            });
        </script>
  
@endsection

@section('style')

    <style>
        .small {
            font-size: 10px; /* Taille de la police */
            padding: 5px 5px 5px 5px; /* Espacement intérieur du bouton */
        }
    </style>

    


@endsection
