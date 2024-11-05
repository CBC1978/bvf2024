@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('src/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">--}}

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
            <h3 class="text-themecolor mb-0">Offres</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Offres</a>
                </li>
                <li class="breadcrumb-item active">Offres reçues</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif
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
                                    id="btn-update-offer"
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
                                    id="btn-delete-offer"
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
                            <div class="col-6"></div>
                        </div>

                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            id="lang_file"
                            class="table table-striped table-bordered display mb-0 display  responsive nowrap" data-page-length='10' width="100%"
                        >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Itinéraire</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Nombre d'offres</th>
                                <th>Date d'expiration</th>
                                <th>Poids (T)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $offer)
                                @if( date("Y-m-d",strtotime($offer->limit_date)) < date('Y-m-d'))
                                    <tr class="bg-danger">
                                @else
                                    <tr>
                                        @endif
                                        <td>
                                            <input type="checkbox" name="offer-detail" id="offer-detail" value="{{ $offer->id }}">
                                        </td>
                                        <td>
                                            @if($offer->origin && $offer->destination)
                                            {{ $offer->origin->libelle.'-'.$offer->destination->libelle }}
                                            @else
                                                Aucun itinéraire renseigné
                                            @endif
                                        </td>
                                        <td>{{ $offer->description }}</td>
                                        <td>{{ $offer->price }}</td>
                                        <td>
                                            <a href="{{ route('getOffersReceivedDetail', $offer->id) }}">
                                                <button
                                                    type="button"
                                                    class="
                                                        btn btn-{{ $offer->offerColor }} btn-circle btn-sm
                                                        d-inline-flex
                                                        align-items-center
                                                        justify-content-center
                                                      "
                                                >
                                                    {{ $offer->offerCount }}
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            {{ date("d-m-Y",strtotime($offer->limit_date))  }}
                                        </td>
                                        <td>
                                            {{ $offer->weight }}
                                        </td>
                                    </tr>
                                    @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Itinéraire</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Nombre d'offres</th>
                                <th>Date d'expiration</th>
                                <th>Poids (T)</th>
                            </tr>
                            </tfoot>
                        </table>

                        {{-- Modal update--}}
                        <div
                            class="modal fade"
                            id="update-offer"
                            tabindex="-1"
                            aria-labelledby="update-offer"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content ">
                                    <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                                        <h4 class="modal-title" id="myLargeModalLabel">
                                            Modifier l'offre
                                        </h4>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="card-title mb-3">Modifier cette offre</h4>
                                        <form method="post" action="{{ route('updatePublishOffer') }}" >
                                            @csrf
                                            <div class="row" id="formUpdateOffer">
                                                @if(Session::get('role') == env('ROLE_CARRIER'))
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-floating mb-3">
                                                                <select
                                                                    name="origin_up"
                                                                    id="origin_up"
                                                                    class="form-control"
                                                                    style="width: 100%; height: 36px"
                                                                >

                                                                </select>
                                                                <label
                                                                ><i
                                                                        class="feather-sm text-dark fill-white me-2"
                                                                    ></i
                                                                    >Lieu de départ </label
                                                                >
                                                            </div>
                                                            <div class="form-floating mb-3">
                                                                <input
                                                                    type="date"
                                                                    name="limit_date_up"
                                                                    id="limit_date_up"
                                                                    value=""
                                                                    required
                                                                    class="form-control"
                                                                />
                                                                <input
                                                                    type="hidden"
                                                                    name="id_offer_up"
                                                                    id="id_offer_up"
                                                                    value=""
                                                                    required
                                                                    class="form-control"
                                                                />
                                                                <label
                                                                ><i
                                                                        class="feather-sm text-dark fill-white me-2"
                                                                    ></i
                                                                    >Date d'expiration <span class="text-danger">*</span> </label
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-floating mb-3">
                                                                <select
                                                                    name="destination_up"
                                                                    id="destination_up"
                                                                    class="form-control"

                                                                    style="width: 100%; height: 36px"
                                                                >
                                                                </select>
                                                                <label
                                                                ><i
                                                                        class="feather-sm text-dark fill-white me-2"
                                                                    ></i
                                                                    >Lieu de destination</label
                                                                >
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-8">
                                                                    <div class="form-floating mb-3">
                                                                        <input
                                                                            type="number"
                                                                            step="0.01"
                                                                            name="price_up"
                                                                            value=""
                                                                            id="price_up"
                                                                            class="form-control"
                                                                            placeholder="Prix"
                                                                        />
                                                                        <label
                                                                        ><i
                                                                                class="feather-sm text-dark fill-white me-2"
                                                                            ></i
                                                                            >Prix</label
                                                                        >
                                                                    </div>
                                                                </div>
                                                                <div class="col-3" id="type_price_up">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-2 mb-3">
                                                                <button
                                                                    type="button"
                                                                    class="
                                                                      justify-content-center
                                                                      w-100
                                                                      btn btn-rounded btn-outline-success
                                                                      d-flex
                                                                      align-items-center
                                                                    "
                                                                    id="btnst"
                                                                >
                                                                    <i
                                                                        data-feather="plus-circle"
                                                                        class="feather-sm fill-white me-2"
                                                                    ></i>
                                                                    ajouter</button>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table
                                                                    id="table-camion_up"
                                                                    class="table table-striped table-bordered display"
                                                                    style="width: 100%">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Nombre camion</th>
                                                                        <th>Caractéristique</th>
                                                                        <th>Charge utilte (T)</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="table-list-vehicules">


                                                                    </tbody>
                                                                    <tfoot>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Nombre camion</th>
                                                                        <th>Caractéristique</th>
                                                                        <th>Charge utilte (T)</th>
                                                                    </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                            <div class="col-6 form-floating mb-3">
                                                                <input
                                                                    type="textarea"
                                                                    name="description_up"
                                                                    id="description_up"
                                                                    value=""
                                                                    required
                                                                    class="form-control"
                                                                    placeholder="Description"

                                                                />
                                                                <label
                                                                ><i
                                                                        class="feather-sm text-dark fill-white me-2"
                                                                    ></i
                                                                    >Description (Précisez la nature de la marchandise)<span class="text-danger">*</span></label
                                                                >
                                                            </div>
                                                            <div class="col-6 form-floating mb-3">
                                                                <input
                                                                    type="number"
                                                                    name="duration_up"
                                                                    id="duration_up"
                                                                    value=""
                                                                    required
                                                                    class="form-control"
                                                                    placeholder="Duration"

                                                                />
                                                                <label
                                                                ><i
                                                                        class="feather-sm text-dark fill-white me-2"
                                                                    ></i
                                                                    >Durée du trajet (en jours)<span class="text-danger">*</span></label
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

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
                                    <div class="modal-footer">

                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        {{-- end Modal--}}


                        {{-- Modal detail--}}
                        <div
                            class="modal fade"
                            id="detail-offer"
                            tabindex="-1"
                            aria-labelledby="detail-offer"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content ">
                                    <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                                        <h4 class="modal-title" id="detailTitle">
                                            Consulter l'offre
                                        </h4>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="card-title mb-3">Détail de l'offre</h4>
                                            <div class="row" id="formDetailOffer">

                                            </div>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        {{-- end Modal--}}


                        {{-- Modal for vehicule offre--}}
                        <div
                            class="modal fade"
                            id="camion-liste_up"
                            tabindex="-1"
                            aria-labelledby="camion-liste_up"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content ">
                                    <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                                        <h4 class="modal-title" id="myLargeModalLabel">
                                            Liste des camions
                                        </h4>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table
                                                id="table_vehicule_up"
                                                class="table table-striped table-bordered display"
                                                style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Immatriculation</th>
                                                    <th>Type</th>
                                                    <th>Modèle</th>
                                                    <th>Marque</th>
                                                    <th>Charge utilte (T)</th>
                                                </tr>
                                                </thead>
                                                <tbody id="table_body_up">

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Immatriculation</th>
                                                    <th>Type</th>
                                                    <th>Modèle</th>
                                                    <th>Marque</th>
                                                    <th>Charge utilte (T)</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button
                                            id="btn-choisir-camion_up"
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
                                                Sélectionner
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        {{-- end Modal --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('src/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>
    <script  src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
    <script  src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.dataTables.js"></script>
    <script src="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('resources/js/bvf/offer/offerReceived.js') }}"></script>
{{--    <script>--}}
{{--        $(document).ready(function (){--}}
{{--            $('#offerReceivedTable').DataTable( {--}}
{{--                responsive: true,--}}
{{--                destroy: true,--}}
{{--                order: [1, 'asc'],--}}
{{--                language: {--}}
{{--                    url: 'https://cdn.datatables.net/plug-ins/2.1.7/i18n/fr-FR.json',--}}
{{--                    "paginate": {--}}
{{--                        "previous": "<",--}}
{{--                        "next": ">",--}}
{{--                        "first": "",--}}
{{--                        "last": ""--}}
{{--                    }--}}
{{--                },--}}
{{--                layout: {--}}
{{--                    autoResize: true,--}}
{{--                    autoSize: true,--}}
{{--                    height: 500,--}}
{{--                    width: 100,--}}
{{--                }--}}
{{--            } );--}}

{{--        });--}}

{{--    </script>--}}
    <script>
        $(document).ready(function () {
            async function getVehicule(){
                const records = await fetch('/vehicules/api').then((res)=>{ return res.json() }).then((res)=>{return res});
                let tab = '';
                records.forEach((obj)=>{
                    tab+=`
                <tr>
                    <td>
                        <input type="checkbox" type="checkbox" name="car-id-offer-up" id="car-id-offer-up" value="${obj.id}">
                    </td>
                    <td>${obj.registration} </td>
                    <td>${obj.fk_type.libelle} </td>
                    <td>${obj.model} </td>
                    <td>${obj.fk_brand.libelle} </td>
                    <td>${obj.payload} </td>
                </tr>
           `;
                });

                document.getElementById('table_body_up').innerHTML = tab;
                $('#table_vehicule_up').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.1.7/i18n/fr-FR.json',
                        "paginate": {
                            "previous": "<",
                            "next": ">",
                            "first": "",
                            "last": ""
                        }
                    },
                    "data": records,
                    columnDefs: [
                        {
                            targets: 0
                        }
                    ],
                    "columns":[
                        {"data":'id',
                            render: (data, type, row) =>
                                '<input type="checkbox" type="checkbox" name="car-id-offer-up" id="car-id-offer-up" value="'+data+'">'
                        },
                        {"data":'registration'},
                        {"data":'fk_type.libelle'},
                        {"data":'model'},
                        {"data":'fk_brand.libelle'},
                        {"data":'payload'}
                    ],
                    retrieve: true,
                });

            }
            //Detail Offer
            $('#btn-detail-offer').click(function (){

                var checkOffers = document.querySelectorAll('#offer-detail');
                var data = [];

                // Verify if checkboxes are checked
                checkOffers.forEach(event => {
                    if(event.checked){
                        data.push(event);
                    }
                });

                if(data.length == 0){
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Aucune ligne sélectionnée',
                        icon: 'error',
                    });
                }

                if( data.length == 1){

                    $('#removeData').remove();
                    fetch('/offre/'+data[0].value)
                        .then(response => response.json())
                        .then(response => {
                            @if(Session::get('role') == env('ROLE_SHIPPER'))

                                $('#formDetailOffer').append(`
                                <div class="row" id="removeData">
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <select
                                                name="origin_plus"
                                                id="origin_plus"
                                                class="form-control"
                                                required
                                                style="width: 100%; height: 36px"
                                            >
                                                <option value="${response.origin.id}" selected>${response.origin.libelle}</option>
                                            </select>
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Lieu de départ <span class="text-danger">*</span> </label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                type="date"
                                                name="limit_date"
                                                value="${response.limit_date}"
                                                id="limit_date_plus"
                                                required
                                                class="form-control"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Date d'expiration <span class="text-danger">*</span> </label
                                            >
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-floating mb-3">
                                                    <input
                                                        type="number"
                                                        step="0.01"
                                                        name="price_plus"
                                                        id="price"
                                                        value="${response.price}"
                                                        required
                                                        class="form-control"
                                                        placeholder="Prix"
                                                    />
                                                    <label
                                                    ><i
                                                            class="feather-sm text-dark fill-white me-2"
                                                        ></i
                                                        >Prix<span class="text-danger">*</span></label
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-3" id="type_price_plus">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <select
                                                name="destination"
                                                id="destination_plus"
                                                class="form-control"
                                                required
                                                style="width: 100%; height: 36px"
                                            >
                                                <option value="${response.destination.id}" selected>${response.destination.libelle}</option>
                                            </select>
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Lieu de destination<span class="text-danger">*</span></label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                type="number"
                                                step="0.01"
                                                name="weight"
                                                id="weight"
                                                value="${response.weight}"
                                                required
                                                class="form-control"
                                                placeholder="Poids"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Poids(T)<span class="text-danger">*</span></label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                type="number"
                                                name="volume"
                                                value="${response.volume}"
                                                id="volume"
                                                class="form-control"
                                                placeholder="Volume"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Volume (m3)</label
                                            >
                                        </div>
                                    </div>
                                    <div class=" col-6 form-floating mb-3">
                                        <input
                                            type="textarea"
                                            name="description"
                                            id="description"
                                            value="${response.description}"
                                            required
                                            class="form-control"
                                            placeholder="Description"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Description (Précisez la nature de la marchandise)<span class="text-danger">*</span></label
                                        >
                                    </div>
                                    <div class=" col-6 form-floating mb-3">
                                        <input
                                            type="number"
                                            name="duration"
                                            id="duration"
                                            value="${response.duration}"
                                            required
                                            class="form-control"
                                            placeholder="duration"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Durée du trajet (en jours) <span class="text-danger">*</span></label
                                        >
                                    </div>
                                </div>
                            `);
                                if(response.type_price == 0){
                                    $('#type_price_plus').append(`
                                   <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_price" checked value="0">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Tonne
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_price" value="1" >
                                        <label class="form-check-label" for="exampleRadios1">
                                            Camion
                                        </label>
                                    </div>
                                `);
                                }
                            else{
                                    $('#type_price_plus').append(`
                                   <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_price"  value="0">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Tonne
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_price" checked value="1" >
                                        <label class="form-check-label" for="exampleRadios1">
                                            Camion
                                        </label>
                                    </div>
                                `);
                            }
                            @elseif(Session::get('role') == env('ROLE_CARRIER'))
                               $('#formDetailOffer').append(`
                                   <div class="row" id="removeData">
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <select
                                                    name="origin_plus"
                                                    id="origin_plus"
                                                    readonly
                                                    class="form-control"
                                                    style="width: 100%; height: 36px"
                                                >
                                                    <option   value="${response.id_origin}" selected>${response.name_origin}</option>
                                                </select>
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Lieu de départ </label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="date"
                                                    name="limit_date"
                                                    id="limit_date"
                                                    value="${response.limit_date}"
                                                    required
                                                    readonly
                                                    class="form-control"
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Date d'expiration <span class="text-danger">*</span> </label
                                                >
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <select
                                                    name="destination_plus"
                                                    id="destination_plus"
                                                    class="form-control"
                                                    readonly
                                                    style="width: 100%; height: 36px"
                                                >
                                                    <option   value="${response.id_destination}" selected>${response.name_destination}</option>
                                                </select>
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Lieu de destination</label
                                                >
                                            </div>
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-floating mb-3">
                                                        <input
                                                            type="number"
                                                            step="0.01"
                                                            name="price"
                                                            value="${response.price}"
                                                            readonly
                                                            id="price"
                                                            class="form-control"
                                                            placeholder="Prix"
                                                        />
                                                        <label
                                                        ><i
                                                                class="feather-sm text-dark fill-white me-2"
                                                            ></i
                                                            >Prix</label
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-3" id="type_price_plus">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="table-responsive">
                                                    <table
                                                        class="table table-striped table-bordered display"
                                                        style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th>Nombre camion</th>
                                                            <th>Caractéristique</th>
                                                            <th>Charge utilte (T)</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="table-list-vehicules_view">

                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>Nombre camion</th>
                                                            <th>Caractéristique</th>
                                                            <th>Charge utilte (T)</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            <div class=" col-6 form-floating mb-3">
                                                <input
                                                    type="textarea"
                                                    name="description"
                                                    id="description"
                                                    value="${response.description}"
                                                    required
                                                    class="form-control"
                                                    placeholder="Description"
                                                    readonly
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Description (Précisez la nature de la marchandise)<span class="text-danger">*</span></label
                                                >
                                            </div>
                                            <div class=" col-6 form-floating mb-3">
                                                <input
                                                    type="number"
                                                    name="duration"
                                                    id="duration"
                                                    value="${response.duration}"
                                                    required
                                                    class="form-control"
                                                    placeholder="Duree"
                                                    readonly
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Durée du trajet ( en jours)<span class="text-danger">*</span></label
                                                >
                                            </div>
                                        </div>
                                    </div>
                               `)
                            if(response.type_price == 0){
                                $('#type_price_plus').append(`
                                 <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type_price" readonly value="0" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Tonne
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" readonly name="type_price" value="1" >
                                    <label class="form-check-label" for="exampleRadios1">
                                        Camion
                                    </label>
                                </div>
                            `);
                            }else{
                                $('#type_price_plus').append(`
                                 <div class="form-check">
                                    <input class="form-check-input" type="radio" readonly name="type_price"  value="0">
                                    <label class="form-check-label" for="exampleRadios1">
                                        Tonne
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" readonly name="type_price" value="1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Camion
                                    </label>
                                </div>
                            `);
                            }
                            //display camions
                            fetch('/transport/car/'+response.id)
                                .then(response => response.json())
                                .then(response=>{
                                    $('#table-list-vehicules_view tr').remove();
                                    if(response.length == 0){
                                        $('#table-list-vehicules_view').append(`
                                            <tr>
                                                <td colspan="4">
                                                    Aucune donnée
                                                </td>

                                            </tr>
                                        `);
                                    }

                                    response.forEach( (obj)=>{
                                            $('#table-list-vehicules_view').append(`
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="number" value="${obj.qte}" placeholder="Entrez le nombre de camion">
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="textarea"
                                                            class="form-control"
                                                            value="${obj.cars.type.libelle+' / '+obj.cars.brand.libelle}" readonly
                                                        />
                                                    </td>
                                                    <td> <input class="form-control mr-5" type="text" value="${obj.cars.payload}" readonly>
                                                    </td>
                                                </tr>
                                        `);
                                        }
                                    );
                                });


                            @endif

                        });
                    $('#detail-offer').modal('show');

                }

                if( data.length >= 2){
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Sélectionnez une seule ligne',
                        icon: 'error',
                    });
                }
                data = [];
            });


            $('#table-list-vehicules').on("click","#removes_field_car", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('td').parent('tr').remove();
            });

            //Choose vehicule
            $("#btn-choisir-camion_up").click(function (){

                var checkOffers_up = document.querySelectorAll('#car-id-offer-up');
                var data_up = [];

                // Verify if checkboxes are checked
                checkOffers_up.forEach(event => {
                    if(event.checked){
                        data_up.push(event);
                    }
                });

                if (data_up.length <= 0) {
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Aucune ligne sélectionnée',
                        icon: 'error',
                    });
                }else{
                    data_up.forEach(obj=>{
                        fetch('/contrat/camion/'+obj.value)
                            .then(res => res.json())
                            .then(res=>{
                                $("#table-list-vehicules").append(`
                                        <tr>
                                            <td>
                                                <input class="form-control" type="hidden" id="id_vehicule_up" name="id_vehicule_up[]" value="${res.id}" >
                                                <span class="input-group-text mr-5" id="removes_field_car">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                      <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                </span>
                                            </td>
                                            <td>
                                                <input class="form-control" type="number" id="nb_vehicule_up" name="nb_vehicule_up[]" value="1" placeholder="Entrez le nombre de camion">
                                            </td>
                                            <td>
                                                    <input
                                                        type="textarea"
                                                        class="form-control"
                                                        value="${res.type.libelle+' / '+res.model}"
                                                    />
                                            </td>
                                            <td> <input class="form-control mr-5" type="text" value="${res.payload}" readonly>
                                            </td>
                                    </tr>
                                `);
                            });
                    });

                }

                $("#camion-liste_up").modal('hide');
            });
            //End Choose vehicule

            $('#btnst').click(function (){
                getVehicule();
                $('#camion-liste_up').modal('show');

            });
            //Update Offer
            $('#btn-update-offer').click(function () {

                var checkOffers = document.querySelectorAll('#offer-detail');
                var data = [];

                // Verify if checkboxes are checked
                checkOffers.forEach(event => {
                    if (event.checked) {
                        data.push(event);
                    }
                })

                if (data.length == 0) {
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Aucune ligne sélectionnée',
                        icon: 'error',
                    });
                }

                if (data.length == 1) {

                    $('#removeData').remove();
                    fetch('/offre/' + data[0].value)
                        .then(response => response.json())
                        .then(response => {
                            @if(Session::get('role') == env('ROLE_SHIPPER'))

                            $('#formUpdateOffer').append(`
                                <div class="row" id="removeData">
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <select
                                                name="origin_up"
                                                id="origin_up"
                                                class="form-control"
                                                required
                                                style="width: 100%; height: 36px"
                                            >
                                                <option value="${response.origin.id}" selected>${response.origin.libelle}</option>
                                            </select>
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Lieu de départ <span class="text-danger">*</span> </label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                type="date"
                                                name="limit_date_up"
                                                value="${response.limit_date}"
                                                id="limit_date_up"
                                                required
                                                class="form-control"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Date d'expiration <span class="text-danger">*</span> </label
                                            >
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-floating mb-3">
                                                    <input
                                                        type="number"
                                                        step="0.01"
                                                        name="price_up"
                                                        id="price_up"
                                                        value="${response.price}"
                                                        required
                                                        class="form-control"
                                                        placeholder="Prix"
                                                    />
                                                    <label
                                                    ><i
                                                            class="feather-sm text-dark fill-white me-2"
                                                        ></i
                                                        >Prix<span class="text-danger">*</span></label
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-3" id="type_price_plus">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <select
                                                name="destination_up"
                                                id="destination_up"
                                                class="form-control"
                                                required
                                                style="width: 100%; height: 36px"
                                            >
                                                <option value="${response.destination.id}" selected>${response.destination.libelle}</option>
                                            </select>
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Lieu de destination<span class="text-danger">*</span></label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                type="number"
                                                step="0.01"
                                                name="weight_up"
                                                id="weight_up"
                                                value="${response.weight}"
                                                required
                                                class="form-control"
                                                placeholder="Poids"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Poids(T)<span class="text-danger">*</span></label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                type="number"
                                                name="volume_up"
                                                value="${response.volume}"
                                                id="volume_up"
                                                class="form-control"
                                                placeholder="Volume"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Volume (m3)</label
                                            >
                                        </div>
                                    </div>
                                    <div class=" col-6 form-floating mb-3">
                                        <input
                                            type="textarea"
                                            name="description_up"
                                            id="description_up"
                                            value="${response.description}"
                                            required
                                            class="form-control"
                                            placeholder="Description"
                                        />
                                         <input type="hidden" value="${response.id}" name="id_offer_up"  id="id_offer_up"/>
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Description (Précisez la nature de la marchandise)<span class="text-danger">*</span></label
                                        >
                                    </div>
                                    <div class=" col-6 form-floating mb-3">
                                        <input
                                            type="number"
                                            name="duration_up"
                                            id="duration_up"
                                            value="${response.duration}"
                                            required
                                            class="form-control"
                                            placeholder="Durée"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Durée du trajet ( en jours) <span class="text-danger">*</span></label
                                        >
                                    </div>
                                </div>
                            `);
                            if(response.type_price == 0){
                                $('#type_price_plus').append(`
                                   <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_price_up" checked value="0">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Tonne
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_price_up" value="1" >
                                        <label class="form-check-label" for="exampleRadios1">
                                            Camion
                                        </label>
                                    </div>
                                `);
                            }
                            else{
                                $('#type_price_plus').append(`
                                   <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_price_up"  value="0">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Tonne
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_price_up" checked value="1" >
                                        <label class="form-check-label" for="exampleRadios1">
                                            Camion
                                        </label>
                                    </div>
                                `);
                            }
                            @elseif(Session::get('role') == env('ROLE_CARRIER'))

                            $('#origin_up').append(`
                                <option   value="${response.id_origin}" selected>${response.name_origin}</option>
                               `);

                            $('#destination_up').append(`
                                <option   value="${response.id_destination}" selected>${response.name_destination}</option>
                               `);

                            $('#limit_date_up ').val(response.limit_date);
                            $('#id_offer_up ').val(response.id);
                            $('#price_up ').val(response.price);
                            $('#description_up ').val(response.description);
                            $('#duration_up ').val(response.duration);

                            $('#RemoveTypeCheck').remove();
                            if(response.type_price == 0){
                                $('#type_price_up').append(`
                                <div id="RemoveTypeCheck">
                                     <div class="form-check" >
                                        <input class="form-check-input" type="radio" name="type_price_up" readonly value="0" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Tonne
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" readonly name="type_price_up" value="1" >
                                        <label class="form-check-label" for="exampleRadios1">
                                            Camion
                                        </label>
                                    </div>
                                </div>
                            `);
                            }else{
                                $('#type_price_up').append(`
                                    <div id="RemoveTypeCheck">
                                         <div class="form-check" >
                                            <input class="form-check-input" type="radio" readonly name="type_price_up"  value="0">
                                            <label class="form-check-label" for="exampleRadios1">
                                                Tonne
                                            </label>
                                        </div>
                                        <div class="form-check" >
                                            <input class="form-check-input" type="radio" readonly name="type_price_up" value="1" checked>
                                            <label class="form-check-label" for="exampleRadios1">
                                                Camion
                                            </label>
                                        </div>
                                    </div>
                            `);
                            }
                            //display camions
                            fetch('/transport/car/'+response.id)
                                .then(response => response.json())
                                .then(response=>{
                                    $('#table-list-vehicules tr').remove();
                                    if(response.length == 0){
                                        $('#table-list-vehicules').append(`
                                            <tr>
                                                <td colspan="4">
                                                    Aucune donnée
                                                </td>

                                            </tr>
                                        `);
                                    }

                                    response.forEach( (obj)=>{
                                            $('#table-list-vehicules').append(`
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="hidden" id="id_vehicule_up" name="id_vehicule_up[]" value="${obj.fk_car}" >
                                                        <span class="input-group-text mr-5" id="removes_field_car">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                            </svg>
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <input class="form-control" type="number" id="id_vehicule_up" name="nb_vehicule_up[]" value="${obj.qte}" placeholder="Entrez le nombre de camion">
                                                    </td>
                                                    <td>
                                                            <input
                                                                type="textarea"
                                                                class="form-control"
                                                                value="${obj.cars.type.libelle+' / '+obj.cars.brand.libelle}" readonly
                                                            />
                                                    </td>
                                                    <td> <input class="form-control mr-5" type="text" value="${obj.cars.payload}" readonly>
                                                    </td>
                                                </tr>
                                        `);
                                        }
                                    );
                                });
                            @endif
                            //Get all villes
                            fetch('/villes')
                                .then(response => response.json())
                                .then(data => {

                                    data.forEach(item => {
                                        $('#origin_up').append(`
                                        <option value="${item.id}" >${item.libelle}</option>
                                    `);
                                        $('#destination_up').append(`
                                        <option value="${item.id}" >${item.libelle}</option>
                                    `);
                                    });

                                });

                            //Get all type of car
                            fetch('/type-car')
                                .then(response => response.json())
                                .then(data => {
                                    data.forEach(item => {
                                        $('#vehicule_type').append(`
                                           <option value="${item.id}"> ${item.libelle}</option>
                                        `)
                                    })
                                });
                        });
                    $('#update-offer').modal('show');
                }

                if (data.length >= 2) {
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Sélectionnez une seule ligne',
                        icon: 'error',
                    });
                }
                data = [];
            });
        });
    </script>
@endsection
