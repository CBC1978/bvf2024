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
            <h3 class="text-themecolor mb-0">Mes Offres</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Offres</a>
                </li>
                <li class="breadcrumb-item active">Postulées</li>
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
                            class="table table-striped table-bordered display"
                            style="width: 100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Prix</th>
                                <th>Description</th>
                                <th>Statut</th>
                                @if(Session::get('role') == env('ROLE_SHIPPER'))
                                    <th>Poids (T)</th>
                                @endif
                                <th>Notification</th>
                                <th>Messagerie</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($offers as $offer)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="offer-detail" id="offer-detail" value="{{ $offer->offer }}">
                                            <input type="hidden" name="offer-apply" id="offer-apply" value="{{ $offer->id }}">
                                        </td>
                                        <td>{{ $offer->price }}</td>
                                        <td>{{ $offer->description }}</td>
                                        <td>
                                            <button
                                                type="button"
                                                class="
                                                btn btn-{{ $offer->statusBtn }}
                                                d-inline-flex
                                                align-items-center
                                                justify-content-center
                                              "
                                            >
                                                {{ $offer->statusMsg }}
                                            </button>
                                        </td>
                                        @if(Session::get('role') == env('ROLE_SHIPPER'))
                                            <td>{{ $offer->weight }}</td>
                                        @endif
                                        <td>
                                        {{-- Vérifiez la valeur de status_message pour décider d'afficher la notification --}}
                                            @if($offer->status == 0)
                                                Aucune notification
                                            @elseif($offer->status == 1)
                                                Vous avez un message
                                            @elseif($offer->status == 3)
                                                Message lu
                                            @endif
                                        </td>
                                        <td>
                                        {{-- Vérifiez si status_message est égal à 2 avant d'afficher le bouton Echanger --}}
{{--                                            @if(Session::get('role') == env('ROLE_SHIPPER'))--}}
{{--                                                @if($offer->status == 1 || $offer->status == 3 )--}}
                                            <form action="{{ route('chat') }}" method="get">
                                                <input type="hidden" value="{{ $offer->id }}" name="offer">
                                                    <button type="submit" class="btn btn-tag btn-info">Discuter</button>
                                            </form>
{{--                                                @endif--}}
{{--                                            @endif--}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Prix</th>
                                <th>Description</th>
                                <th>Statut</th>
                                @if(Session::get('role') == env('ROLE_SHIPPER'))
                                    <th>Poids (T)</th>
                                @endif
                                <th>Notification</th>
                                <th>Messagerie</th>
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
                                        <form method="post" action="{{ route('updateApplyOffer') }}" >
                                            @csrf
                                            <div class="row" id="formUpdateOffer">

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
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $("div.alert").remove();
            }, 5000); //5s

            $('#lang_file tr').click(function (event) {
                if (event.target.type !== 'checkbox') {
                    $(':checkbox', this).trigger('click');
                }
            });

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
                    fetch('/offre-publie/'+data[0].value)
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
                                    <div class="form-floating mb-3">
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
                                            <div class="form-floating mb-3">
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

            //Update Offer
            $('#btn-update-offer').click(function (){

                var checkOffers = document.querySelectorAll('#offer-detail');
                var checkOffersApply = document.querySelectorAll('#offer-apply');
                var data = [];
                var dataApply = [];

                // Verify if checkboxes are checked
                var i =0;
                checkOffers.forEach(event => {
                    if(event.checked){
                        data.push(event);
                        dataApply.push(checkOffersApply[i])
                    }

                    i = i + 1;
                })
                if(data.length == 0){
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Aucune ligne sélectionnée',
                        icon: 'error',
                    });
                }

                if( data.length == 1){

                    var result = fetch('/offre-postulée/'+dataApply[0].value)
                        .then(response => response.json())
                        .then(response => {
                            if (response.status == 1) {
                                Swal.fire({
                                    title: 'Erreur',
                                    text: 'Vous ne pouvez pas modifier une offre acceptée',
                                    icon: 'error',
                                });
                            } else {
                                $('#removeData').remove();
                                $('#formUpdateOffer').append(`
                                <div class="row" id="removeData">
                                    @if(Session::get('role') == env('ROLE_SHIPPER'))
                                        <div class="form-floating mb-3">
                                            <input
                                                type="number"
                                                step="0.01"
                                                name="price"
                                                value="${response.price}"
                                                id="price"
                                                required
                                                class="form-control"
                                                placeholder="Prix"
                                            />
                                                <input
                                                type="hidden"
                                                name="offerId"
                                                value="${response.id}"
                                                id="offerId"
                                                class="form-control"

                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Prix<span class="text-danger">*</span></label
                                            >
                                        </div>
                                    @endif
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
                                        <input type="hidden" value="${response.id}" name="idOffer"  id="idOffer"/>
                                    </div>
                              </div>
                            `);

                                $('#update-offer').modal('show');
                            }
                        })
                }

                if( data.length >= 2){
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Sélectionnez une seule ligne',
                        icon: 'error',
                    });
                }
                data = [];
                dataApply = [];


            });

            //Delete Offer
            $('#btn-delete-offer').click(function(){
                var checkOffers = document.querySelectorAll('#offer-detail');
                var checkOffersApply = document.querySelectorAll('#offer-apply');
                var data = [];
                var dataApply = [];

                // Verify if checkboxes are checked
                var i =0;
                checkOffers.forEach(event => {
                    if(event.checked){
                        data.push(event);
                        dataApply.push(checkOffersApply[i]);
                    }

                    i = i + 1;
                });

                Swal.fire({
                    title: "Voulez vous vraiment supprimez ?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Supprimer",
                    denyButtonText: "Annuler",
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        dataApply.forEach(item =>{
                            fetch('/supprimer-offre-postulées/'+item.value)
                                .then( response => response.json() )
                                .then( response => {
                                    if(response == 0){
                                        Swal.fire({
                                            title: 'Bravo',
                                            text: 'L\'offre a été supprimée avec succès',
                                            icon: 'success',
                                        });
                                    } else if( response == 1){
                                        Swal.fire({
                                            title: 'Erreur',
                                            text: 'Vous n\'êtes pas autorisé à supprimer l\'offre',
                                            icon: 'error',
                                        });
                                    }
                                });
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 7000); //7s
                       // refresh page
                    }
                });

                // dataApply = [];
            });
        });
    </script>
@endsection
