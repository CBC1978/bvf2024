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
                                    id="btn-add-vehicule"
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

            {{-- Modal user--}}
            <div
                class="modal fade"
                id="modal-user"
                tabindex="-1"
                aria-labelledby="modal-user"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                            <h4 class="modal-title">
                                Détail
                            </h4>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <div class="modal-body">
                            <div id="body-modal" ></div>
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

            //Detail User
            $('#btn-add-vehicule').click(function (){

                $('h4.modal-title').text('Ajouter un véhicule');
                $('#body-modal').remove();
                $('.modal-body').append(`
                    <div id="body-modal" >
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
            `);

                fetch('/type-car')
                    .then(response => response.json())
                    .then(response => {
                        response.forEach(item => {
                            $('#type_car').append(`
                            <option value="${item.id}">${item.libelle}</option>
                            `);
                        });
                    });

                fetch('/brand-car')
                    .then(response => response.json())
                    .then(response => {
                        response.forEach(item=>{
                            $('#brand_car').append(`
                            <option value="${item.id}">${item.libelle}</option>
                            `);
                        });
                    });
                $('#modal-user').modal('show');
            });


            $('#formStoreCar').submit(function (e){
                e.preventDefault();
                alert('test');
                var formData = new FormData(this);
                var token = $('#_token').val();
                //Store Message
                // fetch('/contrat/camion/ajouter',{
                //     headers: {
                //         "X-CSRF-Token": token
                //     },
                //     method:"POST",
                //     body:formData ,
                // })
                //     .then(response => response.json())
                //     .then(data =>{
                //         if(data == 0){
                //             Swal.fire({
                //                 title: "Succès",
                //                 text: 'Camion ajouté avec succès',
                //                 icon: 'success',
                //             }).then((result) => {
                //                 /* Read more about isConfirmed, isDenied below */
                //                 if (result.isConfirmed) {
                //                     $('#formAddCar').modal('hide');
                //                     $('#camions').modal('show');
                //                 }
                //             });
                //         }
                //     });
            });

            //Update User
            // $('#btn-update-user').click(function (){
            //
            //     var checkOffers = document.querySelectorAll('#id_user');
            //     var data = [];
            //
            //     // Verify if checkboxes are checked
            //     checkOffers.forEach(event => {
            //         if(event.checked){
            //             data.push(event);
            //         }
            //     });
            //
            //     if(data.length == 0){
            //         Swal.fire({
            //             title: 'Erreur',
            //             text: 'Aucune ligne sélectionnée',
            //             icon: 'error',
            //         });
            //     }
            //
            //     if( data.length == 1){
            //
            //         $('#removeProfil').remove();
            //         fetch('/utilisateur/'+data[0].value)
            //             .then(response => response.json())
            //             .then(response => {
            //
            //                 $('#profile').append(`
            //                       <div class="row" id="removeProfil">
            //                             <div class="col-6">
            //                                 <div class="form-floating mb-3">
            //                                     <input
            //                                         type="text"
            //                                         name="name"
            //                                         id="name"
            //                                         class="form-control"
            //                                         required
            //                                         value="${ response.name}"
            //                                         style="width: 100%; height: 36px"
            //                                     />
            //                                     <input
            //                                         type="hidden"
            //                                         name="id_users"
            //                                         id="id_users"
            //                                         class="form-control"
            //                                         value="${ response.id}"
            //                                         style="width: 100%; height: 36px"
            //                                     />
            //                                 </div>
            //                                 <div class="form-floating mb-3">
            //                                     <input
            //                                         type="text"
            //                                         name="first_name"
            //                                         id="first_name"
            //                                         class="form-control"
            //                                         required
            //                                         value="${ response.first_name}"
            //                                         style="width: 100%; height: 36px"
            //                                     />
            //                                     <label
            //                                     ><i
            //                                         class="feather-sm text-dark fill-white me-2"
            //                                         ></i
            //                                         >Prénom(s)<span class="text-danger">*</span> </label
            //                                     >
            //                                 </div>
            //                                 <div class="form-floating mb-3">
            //                                     <input
            //                                         type="text"
            //                                         name="user_phone"
            //                                         id="user_phone"
            //                                         required
            //                                         value="${ response.user_phone}"
            //                                         class="form-control"
            //                                     />
            //                                     <label
            //                                     ><i
            //                                             class="feather-sm text-dark fill-white me-2"
            //                                         ></i
            //                                         >Téléphone <span class="text-danger">*</span></label
            //                                     >
            //                                 </div>
            //                                 <div class="form-floating mb-3">
            //                                     <input
            //                                         type="text"
            //                                         name="email"
            //                                         id="email"
            //                                         required
            //                                         value="${ response.email }"
            //                                         class="form-control"
            //                                         style="width: 100%; height: 36px"
            //                                         />
            //                                         <label
            //                                         ><i
            //                                                 class="feather-sm text-dark fill-white me-2"
            //                                             ></i
            //                                             >Email<span class="text-danger">*</span></label
            //                                         >
            //                                 </div>
            //                             </div>
            //                             <div class="col-6">
            //                                 <div class="form-floating mb-3">
            //                                     <input
            //                                         type="text"
            //                                         name="username"
            //                                         id="username"
            //                                         required
            //                                         value="${ response.username }"
            //                                         class="form-control"
            //                                     />
            //                                     <label
            //                                     ><i
            //                                             class="feather-sm text-dark fill-white me-2"
            //                                         ></i
            //                                         >Nom d'utilisateur <span class="text-danger">*</span></label
            //                                     >
            //                                 </div>
            //                                 <div class="form-floating mb-3">
            //                                     <input
            //                                         type="password"
            //                                         name="password"
            //                                         id="password"
            //                                         value=""
            //                                         class="form-control"
            //                                     />
            //                                     <label
            //                                     ><i
            //                                             class="feather-sm text-dark fill-white me-2"
            //                                         ></i
            //                                         >Mot de passe<span class="text-danger">*</span></label
            //                                     >
            //                                 </div>
            //                                 <div class="form-floating mb-3">
            //                                     <input
            //                                         type="password"
            //                                         name="cpassword"
            //                                         id="cpassword"
            //                                         value=""
            //                                         class="form-control"
            //                                     />
            //                                     <label
            //                                     ><i
            //                                             class="feather-sm text-dark fill-white me-2"
            //                                         ></i
            //                                         >Confirmer le mot de passe<span class="text-danger">*</span></label
            //                                     >
            //                                 </div>
            //                                 <div class="form-floating mb-3">
            //                                     <select
            //                                         name="roles"
            //                                         id="roles"
            //                                         class="form-control"
            //                                         required
            //                                         style="width: 100%; height: 36px"
            //                                     >
            //                                         <option value="${response.role}" selected>${response.role}</option>
            //                                         <option value="transporteur" >Transporteur</option>
            //                                         <option value="chargeur" >Chargeur</option>
            //                                     </select>
            //                                     <label
            //                                     ><i
            //                                             class="feather-sm text-dark fill-white me-2"
            //                                         ></i
            //                                         >Rôle<span class="text-danger">*</span> </label
            //                                     >
            //                                 </div>
            //                             </div>
            //                       </div>
            //                 `);
            //                 $('#update-user').modal('show');
            //             });
            //     }
            //
            //     if( data.length >= 2){
            //         Swal.fire({
            //             title: 'Erreur',
            //             text: 'Sélectionnez une seule ligne',
            //             icon: 'error',
            //         });
            //     }
            //     data = [];
            //     checkOffers.forEach(event => {
            //         if(event.checked){
            //             event.checked = false;
            //         }
            //     });
            //
            // });
            // $('#formUser').submit(function (e){
            //     e.preventDefault();
            //     var formData = new FormData(this);
            //     var token = $('#_token').val();
            //     //Store Message
            //     fetch('/utilisateur/modifier',{
            //         headers: {
            //             "X-CSRF-Token": token
            //         },
            //         method:"POST",
            //         body:formData ,
            //     })
            //         .then(response => response.json())
            //         .then(data =>{
            //             if(data == 0){
            //                 Swal.fire({
            //                     title: "Succès",
            //                     text: 'Utilisateur moidifié avec succès',
            //                     icon: 'success',
            //                 });
            //
            //             }else if(data == 1){
            //                 Swal.fire({
            //                     title: "Erreur",
            //                     text: 'Les mots de passes ne correspondent pas',
            //                     icon: 'error',
            //                 });
            //             }
            //         });
            //
            //     setTimeout(function () {
            //         location.reload();
            //     }, 3000); //5s refresh page
            // });
            //
            // $('#roles').change(function (){
            //     console.log('test');
            //     $( "#structures option").each(function (){
            //         $(this).remove();
            //     });
            //     var obj = $('#structures option:selected').val();
            //     if(obj == 'chargeur'){
            //
            //         fetch('/chargeur/liste')
            //             .then(response=>response.json())
            //             .then(response=>{
            //
            //                 response.forEach(item=>{
            //                     $('#structures').append(`
            //                                 <option value ="${item.id}">${item.company_name}</option>
            //                             `);
            //                 });
            //             });
            //     } else if(obj == 'transporteur'){
            //         fetch('/transporteur/liste')
            //             .then(response=>response.json())
            //             .then(response=>{
            //                 response.forEach(item=>{
            //                     $('#structures').append(`
            //                                 <option value ="${item.id}">${item.company_name}</option>
            //                             `);
            //                 });
            //             });
            //     }
            //
            //
            //
            // });
            // //Activer User
            // $('#btn-activer-user').click(function(){
            //     var checkOffers = document.querySelectorAll('#id_user');
            //     var data = [];
            //
            //     // Verify if checkboxes are checked
            //     checkOffers.forEach(event => {
            //         if(event.checked){
            //             data.push(event);
            //         }
            //     });
            //
            //     data.forEach(item =>{
            //         fetch('/utilisateur/2/'+item.value)
            //             .then( response => response.json() )
            //             .then( response => {
            //                 if(response == 0){
            //                     Swal.fire({
            //                         title: 'Bravo',
            //                         text: 'L\'utilisateur est désactivé avec succès',
            //                         icon: 'success',
            //                     });
            //                 }
            //             });
            //     });
            //     data = [];
            //     checkOffers.forEach(event => {
            //         if(event.checked){
            //             event.checked = false;
            //         }
            //     });
            //     setTimeout(function () {
            //         location.reload();
            //     }, 3000); //5s refresh page
            //
            // });
            // //Admin User
            // $('#btn-delete-user').click(function(){
            //     var checkOffers = document.querySelectorAll('#id_user');
            //     var data = [];
            //
            //     // Verify if checkboxes are checked
            //     checkOffers.forEach(event => {
            //         if(event.checked){
            //             data.push(event);
            //         }
            //     });
            //     Swal.fire({
            //         title: "Voulez vous vraiment supprimez ?",
            //         showDenyButton: true,
            //         showCancelButton: false,
            //         confirmButtonText: "Supprimer",
            //         denyButtonText: "Annuler",
            //     }).then((result) => {
            //         /* Read more about isConfirmed, isDenied below */
            //         if (result.isConfirmed) {
            //             data.forEach(item =>{
            //                 fetch('/utilisateurs/supprimer/'+item.value)
            //                     .then( response => response.json() )
            //                     .then( response => {
            //                         if(response == 0){
            //                             Swal.fire({
            //                                 title: 'Bravo',
            //                                 text: 'L\'utilisateur a été supprimée avec succès',
            //                                 icon: 'success',
            //                             });
            //                         } else if( response == 1){
            //                             Swal.fire({
            //                                 title: 'Erreur',
            //                                 text: 'Vous n\'êtes pas autorisé à supprimer le camion',
            //                                 icon: 'error',
            //                             });
            //                         }
            //                     });
            //             });
            //             setTimeout(function () {
            //                 location.reload();
            //             }, 3000); //3s
            //             // refresh page
            //         }
            //     });
            //
            // });
        });
    </script>
@endsection
