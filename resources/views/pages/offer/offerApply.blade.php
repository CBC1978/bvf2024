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
                                        <td></td>
                                        <td></td>
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
                            $('#formDetailOffer').append(`
                                  <div class="row" id="removeData">
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input
                                                    readOnly
                                                    name="origin"
                                                    id="origin"
                                                    class="form-control"
                                                    value="${ response.origin.libelle }"
                                                    required
                                                    style="width: 100%; height: 36px"
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Lieu de départ <span class="text-danger">*</span> </label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    readOnly
                                                    type="date"
                                                    name="limit_date"
                                                    id="limit_date"
                                                    value="${ response.limit_date}"
                                                    required
                                                    class="form-control"
                                                    placeholder="Date"
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Date d'expiration <span class="text-danger">*</span></label
                                                >
                                            </div>
                                            @if(Session::get('role') == env('ROLE_CARRIER'))
                                                <div class="form-floating mb-3">
                                                    <input
                                                        readOnly
                                                        type="text"
                                                        name="volume"
                                                        id="volume"
                                                        value="${ response.volume }"
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
                                            @endif
                                        </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input
                                        readOnly
                                        name="destination"
                                        id="destination"
                                        value="${ response.destination.libelle }"
                                        class="form-control"
                                        required
                                        style="width: 100%; height: 36px"
                                    />
                                    <label
                                    ><i
                                            class="feather-sm text-dark fill-white me-2"
                                        ></i
                                        >Lieu de destination<span class="text-danger">*</span></label
                                    >
                                </div>
                                <div class="form-floating mb-3">
                                    <input
                                        readOnly
                                        type="number"
                                        step="0.01"
                                        name="weight"
                                        id="weight"
                                        value="${ response.weight }"
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
                                @if(Session::get('role') == env('ROLE_CARRIER'))
                                    <div class="form-floating mb-3">
                                        <input
                                            readOnly
                                            type="number"
                                            step="0.01"
                                            name="price"
                                            value="${ response.price }"
                                            id="price"
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
                                @endif
                                @if(Session::get('role') == env('ROLE_SHIPPER'))
                                    <div class="form-floating mb-3">
                                        <input
                                            readOnly
                                            name="vehicule_type"
                                            id="vehicule_type"
                                            class="form-control"
                                            value="${ response.vehicule_type.libelle }"
                                            required
                                            style="width: 100%; height: 36px"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Type d'engin<span class="text-danger">*</span></label
                                        >
                                    </div>
                                @endif
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    readOnly
                                    type="textarea"
                                    name="description"
                                    id="description"
                                    value="${response.description }"
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
