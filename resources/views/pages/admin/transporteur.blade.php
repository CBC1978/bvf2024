@extends('layouts.admin.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('src/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection
@section('breadcumbs')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Admin</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Entreprise Transporteur
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
                            id="btn-add-carrier"
                            class="
                                justify-content-center
                                w-100
                                btn btn-rounded btn-outline-success
                                d-flex
                                align-items-center
                                mb-3 mt-3
                            "
                            data-bs-toggle="modal"
                            data-bs-target="#form-add-carrier"
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
                                id="btn-detail-carrier"
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
                                    id="btn-update-carrier"
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
{{--                        <div class="col-md-2 col-sm-12 top">--}}
{{--                            <button--}}
{{--                                id="btn-delete-camion"--}}
{{--                                type="button"--}}
{{--                                class="--}}
{{--                                        justify-content-center--}}
{{--                                        w-100--}}
{{--                                        btn btn-rounded btn-outline-danger--}}
{{--                                        d-flex--}}
{{--                                        align-items-center--}}
{{--                                        mb-3 mt-3--}}
{{--                                        "--}}
{{--                            >--}}
{{--                                <i--}}
{{--                                    data-feather="trash-2"--}}
{{--                                    class="feather-sm fill-white me-2"--}}
{{--                                ></i>--}}
{{--                                Supprimer--}}
{{--                            </button>--}}
{{--                        </div>--}}

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
                                <th>Entreprise</th>
                                <th>Adresse</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Ville</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($carriers)  > env('default_int'))
                                @foreach($carriers as $carrier)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="user-checkbox" name="carrier_id" id="carrier_id" value="{{ $carrier->id }}">
                                        </td>
                                        <td>{{ $carrier->company_name }}</td>
                                        <td>{{ $carrier->address }}</td>
                                        <td>{{ $carrier->email }}</td>
                                        <td>{{ $carrier->phone }}</td>
                                        <td>{{ $carrier->city->libelle }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Entreprise</th>
                                <th>Adresse</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Ville</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal add--}}
<div
    class="modal fade"
    id="form-add-carrier"
    tabindex="-1"
    aria-labelledby="form-add-carrier"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                <h4 class="modal-title" id="detailTitle">
                    Ajouter un transporteur
                </h4>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.ajouter-transporteur') }}" >
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="company_name"
                                    id="company_name"
                                    class="form-control"
                                    required
                                    style="width: 100%; height: 36px"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Raison sociale <span class="text-danger">*</span> </label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="address"
                                    id="address"
                                    required
                                    class="form-control"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Adresse <span class="text-danger">*</span></label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    class="form-control"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Contact</label
                                >
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <select
                                    name="city"
                                    id="city"
                                    class="form-control"
                                    required
                                    style="width: 100%; height: 36px"
                                >
                                    <option disabled selected>Choisir une ville</option>
                                    @foreach($villes as $ville)
                                        <option value="{{$ville->id }}">{{$ville->libelle }}</option>
                                    @endforeach
                                </select>
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Ville<span class="text-danger">*</span></label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    required
                                    class="form-control"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Email<span class="text-danger">*</span></label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    name="ifu"
                                    id="ifu"
                                    required
                                    class="form-control"
                                />
                                <label
                                ><i
                                        class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Numéro Ifu<span class="text-danger">*</span></label
                                >
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    name="rccm"
                                    id="rccm"
                                    class="form-control"
                                    required
                                    style="width: 100%; height: 36px"
                                />
                                <label
                                ><i
                                    class="feather-sm text-dark fill-white me-2"
                                    ></i
                                    >Numéro RCCM<span class="text-danger">*</span></label
                                >
                            </div>
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
                                        data-feather="plus-circle"
                                        class="feather-sm fill-white me-2"
                                    ></i>
                                    Ajouter
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

{{-- Modal update--}}
<div
    class="modal fade"
    id="form-update-carrier"
    tabindex="-1"
    aria-labelledby="form-update-carrier"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                <h4 class="modal-title" id="detailTitle">
                    Modifier le transporteur
                </h4>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('updateCarrier') }}" >
                    @csrf
                    <div class="row" id="formUpdateCarrier">
                        <div id="removeData">

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
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- end Modal--}}
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

            //Update Offer
            $('#btn-update-carrier').click(function (){

                var checkOffers = document.querySelectorAll('#carrier_id');
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

                    $('#removeData').remove();
                    fetch('/modifier-transporteur/'+data[0].value)
                        .then(response => response.json())
                        .then(response => {
                            console.log(response);
                            $('#formUpdateCarrier').append(`
                                  <div class="row" id="removeData">
                                   <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input
                                                type="text"
                                                name="company_name"
                                                id="company_name"
                                                class="form-control"
                                                value="${response.company_name}"
                                                required
                                                style="width: 100%; height: 36px"
                                            />
                                            <input
                                                type="hidden"
                                                name="id_carrier"
                                                id="id_carrier"
                                                class="form-control"
                                                value="${response.id}"
                                                required
                                                style="width: 100%; height: 36px"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Raison sociale <span class="text-danger">*</span> </label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                type="text"
                                                name="address"
                                                id="address"
                                                value="${response.address}"
                                                required
                                                class="form-control"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Adresse <span class="text-danger">*</span></label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                type="text"
                                                name="phone"
                                                id="phone"
                                                value="${response.phone}"
                                                class="form-control"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Contact</label
                                            >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <select
                                                name="city_up"
                                                id="city_up"
                                                class="form-control"
                                                required
                                                style="width: 100%; height: 36px"
                                            >
                                                <option  selected   value="${response.city.id}">${response.city.libelle}</option>
                                        </select>
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Ville<span class="text-danger">*</span></label
                                        >
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            value="${response.email}"
                                            required
                                            class="form-control"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Email<span class="text-danger">*</span></label
                                        >
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            type="text"
                                            name="ifu"
                                            id="ifu"
                                            value="${response.ifu}"
                                            required
                                            class="form-control"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Numéro Ifu<span class="text-danger">*</span></label
                                        >
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            name="rccm"
                                            id="rccm"
                                            value="${response.rccm}"
                                            class="form-control"
                                            required
                                            style="width: 100%; height: 36px"
                                        />
                                        <label
                                        ><i
                                            class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Numéro RCCM<span class="text-danger">*</span></label
                                        >
                                    </div>
                                </div>
                              </div>
                            `);

                            //Get all villes
                            fetch('/villes')
                                .then(response => response.json())
                                .then(data => {
                                    data.forEach(item => {
                                        $('#city_up').append(`
                                        <option value="${ item.id }" >${ item.libelle }</option>
                                    `);
                                    });
                                });
                        });
                    $('#form-update-carrier').modal('show');
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
            $('#btn-detail-carrier').click(function (){

                var checkOffers = document.querySelectorAll('#carrier_id');
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
                    window.location.href = '/transporteur/'+data[0].value;
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

        });
    </script>

@endsection
