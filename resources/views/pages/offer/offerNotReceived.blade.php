@extends('layouts.app')

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
            <h3 class="text-themecolor mb-0">Offres</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Offres</a>
                </li>
                <li class="breadcrumb-item active">Offres non reçues</li>
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
                            class="table table-striped table-bordered display"
                            style="width: 100%">
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
                                @if($offer->limit_date < date('Y-m-d'))
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
                                        </td>
                                        <td>{{ date("d-m-Y",strtotime($offer->limit_date))  }}</td>
                                        <td>{{ $offer->weight }} </td>
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

                        {{-- Modal--}}
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
                                        <h4 class="modal-title" >
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
                                        @if(Session('role') == env('ROLE_SHIPPER'))
                                            <form method="post" action="{{ route('updatePublishOffer') }}" >
                                                @csrf
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-floating mb-3">
                                                            <select
                                                                name="origin_up"
                                                                id="origin_up"
                                                                class="form-control"
                                                                required
                                                                style="width: 100%; height: 36px"
                                                            >
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
                                                                        required
                                                                        class="form-control"
                                                                        placeholder="Prix"
                                                                    />
                                                                    <input
                                                                        type="hidden"
                                                                        name="id_offer_up"
                                                                        id="id_offer_up"
                                                                    />
                                                                    <label
                                                                    ><i
                                                                            class="feather-sm text-dark fill-white me-2"
                                                                        ></i
                                                                        >Prix<span class="text-danger">*</span></label
                                                                    >
                                                                </div>
                                                            </div>
                                                            <div class="col-3" id="type_price_form">

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
                                                    <div class="form-floating mb-3">
                                                        <input
                                                            type="textarea"
                                                            name="description_up"
                                                            id="description_up"
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
                                        @elseif(Session('role') == env('ROLE_CARRIER'))
                                            <form method="post" action="{{ route('updatePublishOffer') }}" >
                                            @csrf
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
                                                                    id="price_up"
                                                                    class="form-control"
                                                                    placeholder="Prix"
                                                                />
                                                                <input
                                                                    type="hidden"
                                                                    name="id_offer_up"
                                                                    id="id_offer_up"
                                                                />
                                                                <label
                                                                ><i
                                                                        class="feather-sm text-dark fill-white me-2"
                                                                    ></i
                                                                    >Prix</label
                                                                >
                                                            </div>
                                                        </div>
                                                        <div class="col-3" id="type_price_form">
                                                        </div>
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
                                                        id="btn_add_camion_up"
                                                    >
                                                        <i
                                                            data-feather="plus-circle"
                                                            class="feather-sm fill-white me-2"
                                                        ></i>
                                                    </button>
                                                </div>
                                                <div>
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
                                                            <tbody id="table-list-vehicule_up">

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
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input
                                                        type="textarea"
                                                        name="description_up"
                                                        id="description_up"
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
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        {{-- end Modal--}}

                        {{--   Modal for vehicule offre--}}
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
                                                id="table_vehicule"
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
    <script src="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('resources/js/bvf/offer/offerNotReceived.js') }}"></script>
    <script>
        $(document).ready(function () {

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

                    $('#removeDataUp').remove();
                    fetch('/offre/' + data[0].value)
                        .then(response => response.json())
                        .then(response => {
                            let departId = (response.origin) ? response.origin.id : '';
                            let departValue = (response.origin) ? response.origin.libelle : '';
                            let arriveId = (response.destination) ? response.destination.id : '';
                            let arriveValue = (response.destination) ? response.destination.libelle : '';

                            if(response.weight){
                                $("#origin_up").append(`
                                    <option value="${departId}" selected >${departValue}</option>
                                `);
                                $("#destination_up").append(`
                                    <option value="${arriveId}" selected >${arriveValue}</option>
                                `);
                                $("#limit_date_up").val(response.limit_date);
                                $("#price_up").val(response.price);
                                $("#id_offer_up").val(response.id);
                                $("#description_up").val(response.description);
                                $("#weight_up").val(response.weight);
                                $("#volume_up").val(response.volume);

                                $("#removeTypePrice").remove();
                                $("#removeTypePrice1").remove();
                                if(response.type_price == 0){
                                    $('#type_price_form').append(`
                                    <div class="form-check" id="removeTypePrice">
                                        <input class="form-check-input" type="radio" name="type_price_up"  value="0" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Tonne
                                        </label>
                                    </div>
                                    <div class="form-check" id="removeTypePrice1">
                                        <input class="form-check-input" type="radio" name="type_price_up" value="1" >
                                        <label class="form-check-label" for="exampleRadios1">
                                            Camion
                                        </label>
                                    </div>
                                `);
                                }else if(response.type_price == 1){
                                    $('#type_price_form').append(`
                                    <div class="form-check" id="removeTypePrice">
                                        <input class="form-check-input" type="radio" name="type_price_up"  value="0">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Tonne
                                        </label>
                                    </div>
                                    <div class="form-check" id="removeTypePrice1">
                                        <input class="form-check-input" type="radio" name="type_price_up" value="1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Camion
                                        </label>
                                    </div>
                                `);
                                }

                            }else {

                                $("#origin_up").append(`
                                    <option value="${departId}" selected >${departValue}</option>
                                `);
                                $("#destination_up").append(`
                                    <option value="${arriveId}" selected >${arriveValue}</option>
                                `);
                                $("#limit_date_up").val(response.limit_date);
                                $("#price_up").val(response.price);
                                $("#id_offer_up").val(response.id);
                                $("#description_up").val(response.description);

                                $("#removeTypePrice").remove();
                                $("#removeTypePrice1").remove();
                                if(response.type_price == 0){
                                    $('#type_price_form').append(`
                                    <div class="form-check" id="removeTypePrice">
                                        <input class="form-check-input" type="radio" name="type_price_up"  value="0" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Tonne
                                        </label>
                                    </div>
                                    <div class="form-check" id="removeTypePrice1">
                                        <input class="form-check-input" type="radio" name="type_price_up" value="1" >
                                        <label class="form-check-label" for="exampleRadios1">
                                            Camion
                                        </label>
                                    </div>
                                `);
                                }else if(response.type_price == 1){
                                    $('#type_price_form').append(`
                                    <div class="form-check" id="removeTypePrice">
                                        <input class="form-check-input" type="radio" name="type_price_up"  value="0">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Tonne
                                        </label>
                                    </div>
                                    <div class="form-check" id="removeTypePrice1">
                                        <input class="form-check-input" type="radio" name="type_price_up" value="1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Camion
                                        </label>
                                    </div>
                                `);
                                }
                                response.cars.forEach(obj=>{
                                    $("#removeTr").remove();
                                });

                                for(i=0; i < response.cars.length; i++){
                                    $('#table-list-vehicule_up').append(
                                        `
                                        <tr id="removeTr">
                                            <td>
                                                <input class="form-control" type="hidden" id="id_vehicule_up" name="id_vehicule_up[]" value="${response.cars[i].car.id}" >
                                                <span class="input-group-text mr-5" id="removes_field_car_up">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                      <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                    </svg>
                                                </span>
                                            </td>
                                            <td>
                                                <input class="form-control" type="number" id="nb_vehicule_up" name="nb_vehicule_up[]" value="${response.cars[i].qte}" placeholder="Entrez le nombre de camion">
                                            </td>
                                            <td>
                                                    <input
                                                        type="textarea"
                                                        class="form-control"
                                                        value="${response.cars[i].type.libelle+' / '+response.cars[i].car.model}"
                                                    />
                                            </td>
                                            <td> <input class="form-control mr-5" type="text" value="${response.cars[i].car.payload}" readonly>
                                            </td>
                                        </tr>
                                        `
                                    );
                                }
                        }

                            // Get all villes
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
            $('#btn_add_camion_up').click(function (){
                getVehicule();
                $('#camion-liste_up').modal('show');
            });
            $('#table-list-vehicule_up').on("click","#removes_field_car_up", function(e){ //user click on remove text
                $(this).parent('td').parent('tr').remove();
            });

            $("#btn-choisir-camion_up").click(function (){
                var checkOffers = document.querySelectorAll('#car-id-offer');
                var data = [];

                // Verify if checkboxes are checked
                checkOffers.forEach(event => {
                    if(event.checked){
                        data.push(event);
                    }
                });

                if (data.length <= 0) {
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Aucune ligne sélectionnée',
                        icon: 'error',
                    });
                }else{
                    data.forEach(obj=>{
                        fetch('/contrat/camion/'+obj.value)
                            .then(res => res.json())
                            .then(res=>{
                                $("#table-list-vehicule_up").append(`
                            <tr>
                                <td>
                                    <input class="form-control" type="hidden" id="id_vehicule_up" name="id_vehicule_up[]" value="${res.id}" >
                                    <span class="input-group-text mr-5" id="removes_field_car_up">
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
            async function getVehicule(){
                 const records = await fetch('/vehicules/api').then((res)=>{ return res.json() }).then((res)=>{return res});
                 let tab = '';
                 records.forEach((obj)=>{
                     tab+=`
                 <tr>
                     <td>
                         <input type="checkbox" type="checkbox" name="car-id-offer" id="car-id-offer" value="${obj.id}">
                     </td>
                     <td>${obj.registration} </td>
                     <td>${obj.fk_type.libelle} </td>
                     <td>${obj.model} </td>
                     <td>${obj.fk_brand.libelle} </td>
                     <td>${obj.payload} </td>
                 </tr>
            `;
                 });

                 document.getElementById('table_body').innerHTML = tab;
                 $('#table_vehicule').DataTable({
                     "data": records,
                     columnDefs: [
                         {
                             targets: 0
                         }
                     ],
                     "columns":[
                         {"data":'id',
                             render: (data, type, row) =>
                                 '<input type="checkbox" type="checkbox" name="car-id-offer" id="car-id-offer" value="'+data+'">'
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

        });

    </script>
@endsection
