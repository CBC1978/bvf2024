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
            <h3 class="text-themecolor mb-0">Utilsateurs</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Utilsateurs</a>
                </li>
                <li class="breadcrumb-item active">Utilsateurs non validés</li>
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
                                    Désactiver
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
                                <th>Nom complet</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Nom d'utilisateur</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($users))
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="user_id" id="user_id" value="{{$user->id}}">
                                        </td>
                                        <td>{{ $user->name.' '.$user->first_name }}</td>
                                        <td>{{ $user->user_phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nom complet</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Nom d'utilisateur</th>
                            </tr>
                            </tfoot>
                        </table>
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
                    fetch('/offre/'+data[0].value)
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
                                            @if(Session::get('role') == env('ROLE_SHIPPER'))
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
                                            @if(Session::get('role') == env('ROLE_SHIPPER'))
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
                            @if(Session::get('role') == env('ROLE_CARRIER'))
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
                console.log(data);

            });

            //Update Offer
            $('#btn-update-offer').click(function (){

                var checkOffers = document.querySelectorAll('#offer-detail');
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
                    fetch('/offre/'+data[0].value)
                        .then(response => response.json())
                        .then(response => {

                            $('#formUpdateOffer').append(`
                                  <div class="row" id="removeData">
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <select
                                                    name="origin"
                                                    id="origin"
                                                    class="form-control"
                                                    required
                                                    style="width: 100%; height: 36px"
                                                >
                                                    <option value="${ response.origin.id }" >${ response.origin.libelle }</option>
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
                                            @if(Session::get('role') == env('ROLE_SHIPPER'))
                            <div class="form-floating mb-3">
                                <input
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
                                    <select
                                        name="destination"
                                        id="destination"
                                        class="form-control"
                                        required
                                        style="width: 100%; height: 36px"
                                    >
                                        <option value="${ response.destination.id }" selected>${ response.destination.libelle }</option>
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
                                            @if(Session::get('role') == env('ROLE_SHIPPER'))
                            <div class="form-floating mb-3">
                                <input
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
                            @if(Session::get('role') == env('ROLE_CARRIER'))
                            <div class="form-floating mb-3">
                                <select
                                    name="vehicule_type"
                                    id="vehicule_type"
                                    class="form-control"
                                    required
                                    style="width: 100%; height: 36px"
                                >
                                    <option value="${ response.vehicule_type.id }" selected>${ response.vehicule_type.libelle }</option>

                                                    </select>
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
                                                        <input type="hidden" value="${ response.id }" name="idOffer"  id="idOffer"/>
                                        </div>
                                  </div>
                            `);

                            //Get all villes
                            fetch('/villes')
                                .then(response => response.json())
                                .then(data => {

                                    data.forEach(item => {
                                        $('#origin').append(`
                                        <option value="${ item.id }" >${ item.libelle }</option>
                                    `);
                                        $('#destination').append(`
                                        <option value="${ item.id }" >${ item.libelle }</option>
                                    `);
                                    });

                                });

                            //Get all type of car
                            fetch('/type-car')
                                .then(response => response.json())
                                .then(data => {
                                    data.forEach(item => {
                                        $('#vehicule_type').append(`
                                           <option value="${ item.id }"> ${ item.libelle }</option>
                                        `)
                                    })
                                });
                        });
                    $('#update-offer').modal('show');
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
                        }, 3000); //5s
                        //refresh page
                    }
                });
            });
        });
    </script>
@endsection
