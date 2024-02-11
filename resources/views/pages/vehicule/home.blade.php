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
            <h3 class="text-themecolor mb-0">Outils</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Véhicules</a>
                </li>
                <li class="breadcrumb-item active">accueil</li>
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
                                    class="
                                      justify-content-center
                                      w-100
                                      btn btn-rounded btn-outline-success
                                      d-flex
                                      align-items-center
                                    "
                                    data-bs-toggle="modal" data-bs-target="#modal-add"
                                >
                                    <i
                                        data-feather="plus-circle"
                                        class="feather-sm fill-white me-2"
                                    ></i>
                                    Ajouter
                                </button>
                            </div>
                            <div class="col-md-2 col-sm-12 top">
                                <button
                                    type="button"
                                    id="btn-update-vehicule"
                                    class="
                                      justify-content-center
                                      w-100
                                      btn btn-rounded btn-outline-warning
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
                                    type="button"
                                    id="btn-delete-vehicule"
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
                                <th>Immatriculation</th>
                                <th>Type</th>
                                <th>Modèle</th>
                                <th>Marque</th>
                                <th>Charge utilte (T)</th>
                                <th>Image</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=1;
//                            @endphp
                            @foreach($cars as $car)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="car-id" id="car-id" value="{{ $car->id }}">
                                    </td>
                                    <td>{{ $car->registration }}</td>
                                    <td>{{ $car->fk_type->libelle }}</td>
                                    <td>{{ $car->model }}</td>
                                    <td>{{ $car->fk_brand->libelle }}</td>
                                    <td>{{ $car->payload }}</td>
                                    <td>
                                        @if(isset($car->image) && !empty($car->image))
                                            <button class="mt-3 btn btn btn-rounded btn-light-info " data-bs-toggle="modal" data-bs-target="#afficher-image" >
                                                Afficher
                                            </button>
                                        @endif
                                    </td>
                                </tr>


                                {{-- Modal affocher image--}}
                                <div
                                    class="modal fade"
                                    id="afficher-image"
                                    tabindex="-1"
                                    aria-labelledby="afficher-image"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content ">
                                            <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                                                <h4 class="modal-title" id="myLargeModalLabel">
                                                  Afficher image
                                                </h4>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"
                                                ></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="'http://boursebf.test/images/car/'.$car->image )}}" alt="">
                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                {{-- end Modal --}}
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Immatriculation</th>
                                <th>Type</th>
                                <th>Modèle</th>
                                <th>Marque</th>
                                <th>Charge utilte (T)</th>
                                <th>Image</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Modal add vehicule--}}
            <div
                class="modal fade"
                id="modal-add"
                tabindex="-1"
                aria-labelledby="modal-add"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                            <h4 class="modal-title">
                                Ajouter un camion
                            </h4>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <form  action="{{route('storeCar')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row" >
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input
                                                type="text"
                                                name="registration"
                                                id="registration"
                                                required
                                                class="form-control"
                                                placeholder="11GH0000"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Immatriculation <span class="text-danger">*</span></label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select
                                                name="type_car"
                                                id="type_car"
                                                class="form-control"
                                                required
                                                style="width: 100%; height: 36px"
                                            >
                                                <option disabled selected>Choisir un type de camion</option>
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}" selected>{{$type->libelle}}</option>
                                                @endforeach

                                            </select>
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Type de camion <span class="text-danger">*</span> </label
                                            >
                                        </div>

                                        <div class="form-floating mb-3">
                                            <select
                                                name="brand_car"
                                                id="brand_car"
                                                class="form-control"
                                                required
                                                style="width: 100%; height: 36px"
                                            >
                                                <option disabled selected>Choisir une marque de camion</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}" selected>{{$brand->libelle}}</option>
                                                @endforeach

                                            </select>
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Marque du camion <span class="text-danger">*</span> </label
                                            >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input
                                                type="text"
                                                name="model"
                                                id="model"
                                                class="form-control"
                                                placeholder="Modèle"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Modèle</label
                                            >
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input
                                                type="number"
                                                step="0.01"
                                                name="payload"
                                                id="payload"
                                                class="form-control"
                                                placeholder="Charge utile"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Charge utile (T)</label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                type="file"
                                                name="image"
                                                id="image"
                                                class="form-control"
                                                placeholder="image"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Photo</label
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
                                            id="btn-form-car"
                                        >
                                            <div class="d-flex align-items-center">
                                                <i
                                                    data-feather="send"
                                                    class="feather-sm fill-white me-2"
                                                ></i>
                                                Enregistrer
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

            {{-- Modal add vehicule--}}
            <div
                class="modal fade"
                id="modal-update"
                tabindex="-1"
                aria-labelledby="modal-update"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                            <h4 class="modal-title">
                                Modifier un camion
                            </h4>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <form  action="{{route('updateCar')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row" id="row_form" >
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input
                                                type="text"
                                                name="registration_up"
                                                id="registration_up"
                                                required
                                                value=""
                                                class="form-control"

                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Immatriculation <span class="text-danger">*</span></label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select
                                                name="type_car_up"
                                                id="type_car_up"
                                                class="form-control"
                                                required
                                                style="width: 100%; height: 36px"
                                            >
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}" selected>{{$type->libelle}}</option>
                                                @endforeach
                                            </select>
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Type de camion <span class="text-danger">*</span> </label
                                            >
                                        </div>

                                        <div class="form-floating mb-3">
                                            <select
                                                name="brand_car_up"
                                                id="brand_car_up"
                                                class="form-control"
                                                required
                                                style="width: 100%; height: 36px"
                                            >
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}" selected>{{$brand->libelle}}</option>
                                                @endforeach
                                            </select>
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Marque du camion <span class="text-danger">*</span> </label
                                            >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input
                                                type="text"
                                                name="model_up"
                                                value=""
                                                id="model_up"
                                                class="form-control"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Modèle</label
                                            >
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input
                                                type="number"
                                                step="0.01"
                                                name="payload_up"
                                                id="payload_up"
                                                value=""
                                                class="form-control"
                                                placeholder="Charge utile"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Charge utile (T)</label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                type="file"
                                                name="image_up"
                                                id="image_up"
                                                class="form-control"
                                                placeholder="image"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Photo</label
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
                                            id="btn-form-car"
                                        >
                                            <div class="d-flex align-items-center">
                                                <i
                                                    data-feather="send"
                                                    class="feather-sm fill-white me-2"
                                                ></i>
                                                Enregistrer
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


            //Update Car
            $('#btn-update-vehicule').click(function (){

                var checkOffers = document.querySelectorAll('#car-id');
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

                    fetch('/contrat/camion/'+data[0].value)
                        .then(response => response.json())
                        .then(response => {
                            $('#registration_up').val(response.registration);
                            $('#model_up').val(response.model);
                            $('#payload_up').val(response.payload);
                            $('#type_car_up').append(`
                                <option value="${response.type.id}"selected>${response.type.libelle}</option>
                            `);
                            $('#brand_car_up').append(`
                                <option value="${response.brand.id}"selected>${response.brand.libelle}</option>
                            `);
                            $('#payload_up').val(response.payload);

                            $('#row_form').append(
                                `
                                <input type="hidden" value="${response.id}" name="id_car_up" id="id_car_up"/>
                                `
                            );
                        });
                    $('#modal-update').modal('show');

                }

                if( data.length >= 2){
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Sélectionnez une seule ligne',
                        icon: 'error',
                    });
                }
                data = [];
                checkOffers.forEach(event => {
                    if(event.checked){
                        event.checked = false;
                    }
                });

            });

            //Admin User
            $('#btn-delete-vehicule').click(function(){
                var checkOffers = document.querySelectorAll('#car-id');
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
                            fetch('/contrat/camion/supprimer/'+item.value)
                                .then( response => response.json() )
                                .then( response => {
                                    if(response == 0){
                                        Swal.fire({
                                            title: 'Bravo',
                                            text: 'Le camion a été supprimée avec succès',
                                            icon: 'success',
                                        });
                                    } else if( response == 1){
                                        Swal.fire({
                                            title: 'Erreur',
                                            text: 'Vous n\'êtes pas autorisé à supprimer le camion',
                                            icon: 'error',
                                        });
                                    }
                                });
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 3000); //3s
                        // refresh page
                    }
                });

            });
        });
    </script>
@endsection
