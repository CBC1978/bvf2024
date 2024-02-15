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
            <h3 class="text-themecolor mb-0">Contrat</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Contrat</a>
                </li>
                <li class="breadcrumb-item active">Mes contrats de transport</li>
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
                                    id="btn-detail-contrat"
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
                                @if(Session::get('fk_carrier_id') != env('default_int'))
                                    <button
                                        type="button"
                                        id="btn-update-contrat"
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
                                @endif
                            </div>
                            <div class="col-md-2 col-sm-12 top">
{{--                                <button--}}
{{--                                    id="btn-delete-offer"--}}
{{--                                    type="button"--}}
{{--                                    class="--}}
{{--                                      justify-content-center--}}
{{--                                      w-100--}}
{{--                                      btn btn-rounded btn-outline-danger--}}
{{--                                      d-flex--}}
{{--                                      align-items-center--}}
{{--                                    "--}}
{{--                                >--}}
{{--                                    <i--}}
{{--                                        data-feather="trash-2"--}}
{{--                                        class="feather-sm fill-white me-2"--}}
{{--                                    ></i>--}}
{{--                                    Supprimer--}}
{{--                                </button>--}}
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
                                <th>Description</th>
                                <th>Iténaire</th>
                                <th>Poids (T)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($contrats))
                                @foreach($contrats as $obj)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="contrat_id" id="contrat_id" value="{{ $obj->id }}">
                                        </td>
                                        <td>{{ $obj->description }}</td>
                                        <td>{{ $obj->origin->libelle .'-'.$obj->destination->libelle }}</td>
{{--                                        <td>{{ $obj->weight }}</td>--}}
                                    </tr>
                                @endforeach
                            @endif
                            @if(!empty($contratc))
                                @foreach($contratc as $obj)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="contrat_id" id="contrat_id" value="{{ $obj->id }}">
                                        </td>
                                        <td>{{ $obj->description }}</td>
                                        <td>{{ $obj->origin->libelle .'-'.$obj->destination->libelle }}</td>
{{--                                        <td>{{ $obj->weight }}</td>--}}
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                                <th>#</th>
                                <th>Description</th>
                                <th>Iténaire</th>
                                <th>Poids(T)</th>
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
            $('#btn-detail-contrat').click(function (){

                var checkOffers = document.querySelectorAll('#contrat_id');
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

                 window.location.href= "/contrat/"+data[0].value;

                }

                if( data.length >= 2){
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Sélectionnez une seule ligne',
                        icon: 'error',
                    });
                }


            });

            //Update Offer
            $('#btn-update-contrat').click(function (){

                var checkOffers = document.querySelectorAll('#contrat_id');
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
                    window.location.href= "/contrat/modifier/"+data[0].value;
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

            //Delete Offer
            $('#btn-delete-offer').click(function(){
                var checkOffers = document.querySelectorAll('#offer-detail');
                var data = [];

                // Verify if checkboxes are checked
                checkOffers.forEach(event => {
                    if(event.checked){
                        data.push(event);
                    }
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
                        data.forEach(item =>{
                            fetch('/supprimer-offre/'+item.value)
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
                        }, 3000); //3s
                        //refresh page
                    }
                });
            });
        });
    </script>
@endsection
