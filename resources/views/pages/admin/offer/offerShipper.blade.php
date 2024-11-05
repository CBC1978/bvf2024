@extends('layouts.admin.app')
@section('head')
    <link rel="stylesheet" href="{{ asset('src/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection
@section('breadcumbs')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Offres</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Les offres de fret
                    </a>
                </li>
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
                                    id="btn-add-shipper"
                                    class="
                        justify-content-center
                        w-100
                        btn btn-rounded btn-outline-success
                        d-flex
                        align-items-center
                        mb-3 mt-3
                        "
                                    data-bs-toggle="modal"
                                    data-bs-target="#form-add-shipper"
                                >
                                    <i
                                        data-feather="plus-circle"
                                        class="feather-sm fill-white me-2"
                                    ></i>
                                    Ajouter
                                </button>
                            </div>
                            <div class="col-md-3 col-sm-12 top">
                                <button
                                    type="button"
                                    id="btn-detail-shipper"
                                    class="
                        justify-content-center
                        w-100
                        btn btn-rounded btn-outline-warning
                        d-flex
                        align-items-center
                        mb-3 mt-3
                        "
                                >
                                    <i
                                        data-feather="eye"
                                        class="feather-sm fill-white me-2"
                                    ></i>
                                    Détail
                                </button>
                            </div>
                            <div class="col-md-2 col-sm-12 top">
                                <button
                                    type="button"
                                    id="btn-update-shipper"
                                    class="
                                    justify-content-center
                                    w-100
                                    btn btn-rounded btn-outline-info
                                    d-flex
                                    align-items-center
                                    mb-3 mt-3
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
                                    id="btn-bloquer-shipper"
                                    type="button"
                                    class="
                                            justify-content-center
                                            w-100
                                            btn btn-rounded btn-outline-danger
                                            d-flex
                                            align-items-center
                                            mb-3 mt-3
                                            "
                                >
                                    <i
                                        data-feather="lock"
                                        class="feather-sm fill-white me-2"
                                    ></i>
                                    Désactiver
                                </button>
                            </div>
                        </div>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive"  style="overflow-x: auto;">
                        <table
                            id="lang_file"
                            class="table table-striped table-bordered display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Entreprise</th>
                                    <th>Description</th>
                                    <th>Nombre d'offres</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($offers)  > env('default_int'))
                                @foreach($offers as $offer)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="user-checkbox" name="offer_id" id="offer_id" value="{{ $offer->id }}">
                                        </td>
                                        <td>{{ $offer->shipper->company_name }}</td>
                                        <td>{{ $offer->description }}</td>
                                        <td>{{ $offer->transportOffer->count() }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Entreprise</th>
                                    <th>Description</th>
                                    <th>Nombre d'offres</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
     Modal add
    <div
        class="modal fade"
        id="table-offers"
        tabindex="-1"
        aria-labelledby="form-add-shipper"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                    <div class="modal-title" id="detailTitle">
                        <table class="table table-bordered table-striped">
                            <thead id="offerDetailShipper">
                            </thead>
                        </table>
                    </div>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                  <table class="table table-bordered table-striped">
                    <thead id="offerDetailBody">
                    </thead>
                    <tbody>
                    </tbody>

                  </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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

            //Detail Shipper
            $('#btn-detail-shipper').click(function (){

                var checkOffers = document.querySelectorAll('#offer_id');
                var data = [];

                // Verify if checkboxes are checked
                checkOffers.forEach(event => {
                    if(event.checked){
                        data.push(event);
                    }
                })

                if(data.length == 0){
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Aucune ligne sélectionnée',
                        icon: 'error',
                    });
                }

                if( data.length == 1){
                    fetch('/admin/OfferShipper/'+data[0].value)
                        .then(response => response.json())
                        .then(response => {
                         $('#offerDetailShipper').append(`
                                <tr>
                                    <th>${response[0].description}</th>
                                    <th>${response[0].price}</th>
                                    <th>${response[0].weight}</th>
                                    <th>${response[0].origin.libelle+' - '+response[0].destination.libelle}</th>
                                </tr>

                         `);

                         $('#offerDetailBody').append(``);
                            $('#table-offers').modal('show');
                        });

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
            //Detail Shipper
            $('#btn-bloquer-shipper').click(function (){

                var checkOffers = document.querySelectorAll('#shipper_id');
                var data = [];

                // Verify if checkboxes are checked
                checkOffers.forEach(event => {
                    if(event.checked){
                        data.push(event);
                    }
                })

                if(data.length == 0){
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Aucune ligne sélectionnée',
                        icon: 'error',
                    });
                }

                if( data.length == 1){
                    fetch('/modifier-chargeur-statut/'+data[0].value)
                        .then(response => response.json())
                        .then(response => {
                            if(response == 0){
                                Swal.fire({
                                    title: 'Bravo',
                                    text: 'Le statut a été modifié avec succès',
                                    icon: 'success',
                                });
                            }else{
                                Swal.fire({
                                    title: 'Erreur',
                                    text: 'Le statut n\'a pas été modifié',
                                    icon: 'error',
                                });
                            }
                        });
                }

                if( data.length >= 2){
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Sélectionnez une seule ligne',
                        icon: 'error',
                    });
                }
                data = [];
                setTimeout(function () {
                    location.reload();
                }, 2000); //5s

            });
        });
    </script>
@endsection
