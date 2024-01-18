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
                                    id="btn-detail-user"
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
                                    id="btn-activer-user"
                                    class="
                                      justify-content-center
                                      w-100
                                      btn btn-rounded btn-outline-info
                                      d-flex
                                      align-items-center
                                    "
                                >
                                    <i
                                        data-feather="toggle-right"
                                        class="feather-sm fill-white me-2"
                                    ></i>
                                    Activer
                                </button>
                            </div>
                            <div class="col-md-2 col-sm-12 top">
                                <button
                                    type="button"
                                    id="btn-admin-user"
                                    class="
                                      justify-content-center
                                      w-100
                                      btn btn-rounded btn-outline-warning
                                      d-flex
                                      align-items-center
                                    "
                                >
                                    <i
                                        data-feather="user-plus"
                                        class="feather-sm fill-white me-2"
                                    ></i>
                                    Admin
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
                                <th>Nom complet</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Raison sociale</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="user-checkbox" id="id_user" name="id_user" value="{{ $user->id }}">
                                    </td>
                                    <td>{{ $user->name }} {{$user->first_name }}</td>
                                    <td>{{$user->user_phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if($user->company)
                                        <td>{{ $user->company->company_name}}</td>
                                    @endif

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nom complet</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Raison sociale</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Modal detail--}}
            <div
                class="modal fade"
                id="detail-user"
                tabindex="-1"
                aria-labelledby="detail-user"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                            <h4 class="modal-title" id="detail-use">
                                Détail sur l'utilisateur
                            </h4>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <h4 class="card-title mb-3">profil</h4>
                            <div class="row" id="profil">

                            </div>
                        </div>
                        <div class="modal-body">
                            <h4 class="card-title mb-3">Structure</h4>
                            <div class="row" id="structure">

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
            $('#btn-detail-user').click(function (){

                var checkOffers = document.querySelectorAll('#id_user');
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
                    $('#removeStructure').remove();
                    fetch('/utilisateur/'+data[0].value)
                        .then(response => response.json())
                        .then(response => {
                            $('#profil').append(`
                                  <div class="row" id="removeData">
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input
                                                    readOnly
                                                    type="text"
                                                    class="form-control"
                                                    value="${ response.name+' '+response.first_name }"
                                                    style="width: 100%; height: 36px"
                                                />
                                                <label
                                                ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Nom complet <span class="text-danger">*</span> </label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    readOnly
                                                    type="text"
                                                    value="${ response.user_phone}"
                                                    class="form-control"
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Téléphone <span class="text-danger">*</span></label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    readOnly
                                                    type="text"
                                                    value="${ response.email }"
                                                    class="form-control"
                                                    style="width: 100%; height: 36px"
                                                    />
                                                    <label
                                                    ><i
                                                            class="feather-sm text-dark fill-white me-2"
                                                        ></i
                                                        >Email</label
                                                    >
                                            </div>
                                        </div>
                                        <div class="col-6">

                                            <div class="form-floating mb-3">
                                                <input
                                                    readOnly
                                                    type="text"
                                                    value="${ response.username }"
                                                    class="form-control"
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Nom d'utilisateur</label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    readOnly
                                                    type="text"
                                                    value="${ response.role }"
                                                    class="form-control"
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Rôle</label
                                                >
                                            </div>
                                        </div>
                                  </div>
                            `);
                            $('#structure').append(`
                                  <div class="row" id="removeStructure">
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input
                                                    readOnly
                                                    type="text"
                                                    class="form-control"
                                                    value="${ response.company.company_name }"
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
                                                    readOnly
                                                    type="text"
                                                    value="${ response.company.address}"
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
                                                    readOnly
                                                    type="text"
                                                    value="${ response.company.city.libelle }"
                                                    class="form-control"
                                                    style="width: 100%; height: 36px"
                                                    />
                                                    <label
                                                    ><i
                                                            class="feather-sm text-dark fill-white me-2"
                                                        ></i
                                                        >Ville</label
                                                    >
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input
                                                    readOnly
                                                    type="text"
                                                    value="${ response.company.email }"
                                                    class="form-control"
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Email</label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    readOnly
                                                    type="text"
                                                    value="${ response.company.ifu }"
                                                    class="form-control"
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Numéro IFU</label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    readOnly
                                                    type="text"
                                                    value="${ response.company.rccm }"
                                                    class="form-control"
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Numéro RCCM</label
                                                >
                                            </div>
                                        </div>
                                  </div>
                            `);
                        });
                    $('#detail-user').modal('show');

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

            //Activer Offer
            $('#btn-activer-user').click(function(){
                var checkOffers = document.querySelectorAll('#id_user');
                var data = [];

                // Verify if checkboxes are checked
                checkOffers.forEach(event => {
                    if(event.checked){
                        data.push(event);
                    }
                });

                data.forEach(item =>{
                    fetch('/utilisateur/0/'+item.value)
                        .then( response => response.json() )
                        .then( response => {
                            if(response == 0){
                                Swal.fire({
                                    title: 'Bravo',
                                    text: 'L\'utilisateur est activé avec succès',
                                    icon: 'success',
                                });
                            }
                        });
                });
                setTimeout(function () {
                    location.reload();
                }, 5000); //5s refresh page

            });
            $('#btn-admin-user').click(function(){
                var checkOffers = document.querySelectorAll('#id_user');
                var data = [];

                // Verify if checkboxes are checked
                checkOffers.forEach(event => {
                    if(event.checked){
                        data.push(event);
                    }
                });

                data.forEach(item =>{
                    fetch('/utilisateur/1/'+item.value)
                        .then( response => response.json() )
                        .then( response => {
                            if(response == 0){
                                Swal.fire({
                                    title: 'Bravo',
                                    text: 'L\'utilisateur est nommé administrateur avec succès',
                                    icon: 'success',
                                });
                            }
                        });
                });
                setTimeout(function () {
                    location.reload();
                }, 5000); //5s refresh page

            });
        });
    </script>
@endsection
