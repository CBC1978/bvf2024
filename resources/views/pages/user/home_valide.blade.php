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
                <li class="breadcrumb-item active">Utilsateurs validés</li>
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
                                    Désactiver
                                </button>
                            </div>
                            <div class="col-md-2 col-sm-12 top">
                                <button
                                    type="button"
                                    id="btn-update-user"
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
                                    id="btn-delete-user"
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
                                <th>Nom complet</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Raison sociale</th>
                                <th>Rôle</th>
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
                                    <td>
                                        @if($user->status == env('STATUS_ADMIN'))
                                            Admin
                                        @elseif($user->status == env('DEFAULT_VALID'))
                                            Membre
                                        @endif
                                    </td>
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
                                <th>Rôle</th>
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
                            <h4 class="modal-title" id="detail-user">
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

            {{-- Modal update--}}
            <div
                class="modal fade"
                id="update-user"
                tabindex="-1"
                aria-labelledby="update-user"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                            <h4 class="modal-title" id="update-user">
                                Modifier l'utilisateur
                            </h4>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <form id="formUser" method="POST">
                            @csrf
                            <input type="hidden" value="{{ csrf_token() }}" id="_token">
                            <div class="modal-body">
                                <h4 class="card-title mb-3">profil</h4>
                                <div class="row" id="profile">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="d-md-flex align-items-center">
                                    <div class="mt-3 mt-md-0 ms-auto">
                                        <button
                                            type=""
                                            class="
                                    btn btn-info
                                    font-weight-medium
                                    rounded-pill
                                    px-4
                                "
                                        >
                                            <div class="d-flex align-items-center">
                                                <i
                                                    data-feather="edit"
                                                    class="feather-sm fill-white me-2"
                                                ></i>
                                                Modifier
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
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

            //Detail User
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
            //Update User
            $('#btn-update-user').click(function (){

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

                    $('#removeProfil').remove();
                    fetch('/utilisateur/'+data[0].value)
                        .then(response => response.json())
                        .then(response => {

                            $('#profile').append(`
                                  <div class="row" id="removeProfil">
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="text"
                                                    name="name"
                                                    id="name"
                                                    class="form-control"
                                                    required
                                                    value="${ response.name}"
                                                    style="width: 100%; height: 36px"
                                                />
                                                <input
                                                    type="hidden"
                                                    name="id_users"
                                                    id="id_users"
                                                    class="form-control"
                                                    value="${ response.id}"
                                                    style="width: 100%; height: 36px"
                                                />
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="text"
                                                    name="first_name"
                                                    id="first_name"
                                                    class="form-control"
                                                    required
                                                    value="${ response.first_name}"
                                                    style="width: 100%; height: 36px"
                                                />
                                                <label
                                                ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Prénom(s)<span class="text-danger">*</span> </label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="text"
                                                    name="user_phone"
                                                    id="user_phone"
                                                    required
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
                                                    type="text"
                                                    name="email"
                                                    id="email"
                                                    required
                                                    value="${ response.email }"
                                                    class="form-control"
                                                    style="width: 100%; height: 36px"
                                                    />
                                                    <label
                                                    ><i
                                                            class="feather-sm text-dark fill-white me-2"
                                                        ></i
                                                        >Email<span class="text-danger">*</span></label
                                                    >
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="text"
                                                    name="username"
                                                    id="username"
                                                    required
                                                    value="${ response.username }"
                                                    class="form-control"
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Nom d'utilisateur <span class="text-danger">*</span></label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="password"
                                                    name="password"
                                                    id="password"
                                                    value=""
                                                    class="form-control"
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Mot de passe<span class="text-danger">*</span></label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="password"
                                                    name="cpassword"
                                                    id="cpassword"
                                                    value=""
                                                    class="form-control"
                                                />
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Confirmer le mot de passe<span class="text-danger">*</span></label
                                                >
                                            </div>
                                            <div class="form-floating mb-3">
                                                <select
                                                    name="roles"
                                                    id="roles"
                                                    class="form-control"
                                                    required
                                                    style="width: 100%; height: 36px"
                                                >
                                                    <option value="${response.role}" selected>${response.role}</option>
                                                    <option value="transporteur" >Transporteur</option>
                                                    <option value="chargeur" >Chargeur</option>
                                                </select>
                                                <label
                                                ><i
                                                        class="feather-sm text-dark fill-white me-2"
                                                    ></i
                                                    >Rôle<span class="text-danger">*</span> </label
                                                >
                                            </div>
                                        </div>
                                  </div>
                            `);
                            $('#update-user').modal('show');
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
                checkOffers.forEach(event => {
                    if(event.checked){
                        event.checked = false;
                    }
                });

            });
            $('#formUser').submit(function (e){
                e.preventDefault();
                var formData = new FormData(this);
                var token = $('#_token').val();
                //Store Message
                fetch('/utilisateur/modifier',{
                    headers: {
                        "X-CSRF-Token": token
                    },
                    method:"POST",
                    body:formData ,
                })
                    .then(response => response.json())
                    .then(data =>{
                        if(data == 0){
                            Swal.fire({
                                title: "Succès",
                                text: 'Utilisateur moidifié avec succès',
                                icon: 'success',
                            });

                        }else if(data == 1){
                            Swal.fire({
                                title: "Erreur",
                                text: 'Les mots de passes ne correspondent pas',
                                icon: 'error',
                            });
                        }
                    });

                setTimeout(function () {
                    location.reload();
                }, 3000); //5s refresh page
            });

            $('#roles').change(function (){
                console.log('test');
                $( "#structures option").each(function (){
                    $(this).remove();
                });
                var obj = $('#structures option:selected').val();
                if(obj == 'chargeur'){

                    fetch('/chargeur/liste')
                        .then(response=>response.json())
                        .then(response=>{

                            response.forEach(item=>{
                                $('#structures').append(`
                                            <option value ="${item.id}">${item.company_name}</option>
                                        `);
                            });
                        });
                } else if(obj == 'transporteur'){
                    fetch('/transporteur/liste')
                        .then(response=>response.json())
                        .then(response=>{
                            response.forEach(item=>{
                                $('#structures').append(`
                                            <option value ="${item.id}">${item.company_name}</option>
                                        `);
                            });
                        });
                }



            });
            //Activer User
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
                    fetch('/utilisateur/2/'+item.value)
                        .then( response => response.json() )
                        .then( response => {
                            if(response == 0){
                                Swal.fire({
                                    title: 'Bravo',
                                    text: 'L\'utilisateur est désactivé avec succès',
                                    icon: 'success',
                                });
                            }
                        });
                });
                data = [];
                checkOffers.forEach(event => {
                    if(event.checked){
                        event.checked = false;
                    }
                });
                setTimeout(function () {
                    location.reload();
                }, 3000); //5s refresh page

            });
            //Admin User
            $('#btn-delete-user').click(function(){
                var checkOffers = document.querySelectorAll('#id_user');
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
                            fetch('/utilisateurs/supprimer/'+item.value)
                                .then( response => response.json() )
                                .then( response => {
                                    if(response == 0){
                                        Swal.fire({
                                            title: 'Bravo',
                                            text: 'L\'utilisateur a été supprimée avec succès',
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
