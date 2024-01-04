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
                                    id="btn-assign-user"
                                    class="
                                    justify-content-center
                                    w-100
                                    btn btn-rounded btn-outline-success
                                    d-flex
                                    align-items-center
                                    mb-3 mt-3
                                "
                                >
                                    <i
                                        data-feather="plus-circle"
                                        class="feather-sm fill-white me-2"
                                    ></i>
                                    Assigner
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
                                <th>Statut</th>
                                <th>Nom d'utilisateur</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($users)  > env('default_int'))
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="user-checkbox" name="user_id" id="user_id" value="{{ $user->id }}">
                                        </td>
                                        <td>{{ $user->name.' '.$user->first_name }}</td>
                                        <td>{{ $user->user_phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->status == env('STATUS_VALID'))
                                                <button
                                                type="button"
                                                class="
                                                w-100
                                                btn btn-danger
                                                d-inline-flex
                                                align-items-center
                                                justify-content-center
                                                "
                                                >
                                                Non validé
                                                </button>
                                            @elseif($user->status == env('DEFAULT_VALID'))
                                                <button
                                                    type="button"
                                                    class="
                                                    btn btn-success
                                                    d-inline-flex
                                                    align-items-center
                                                    justify-content-center
                                                    "
                                                >
                                                    validé
                                                </button>
                                            @elseif($user->status > env('DEFAULT_VALID'))
                                                <button
                                                    type="button"
                                                    class="
                                                    btn btn-primary
                                                    d-inline-flex
                                                    align-items-center
                                                    justify-content-center
                                                    "
                                                >
                                                    admin
                                                </button>
                                            @endif
                                        </td>
                                        <td>{{ $user->username }}</td>
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
            $('#btn-assign-user').click(function (){

                var checkOffers = document.querySelectorAll('#user_id');
                var carrier = $('#carrier_id').val();
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

                if( data.length > 0){
                    data.forEach(obj=>{
                        fetch('/affecter-user-transporteur/'+obj.value)
                            .then(response => response.json())
                            .then(response => {

                            });
                    });
                    Swal.fire({
                        title: 'Succès',
                        text: 'L\'assignation est effective',
                        icon: 'success',
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 3000); //3s

                }
                data = [];
            });
        });
    </script>
@endsection
