$(document).ready(function () {
    setTimeout(function () {
        $("div.alert").remove();
    }, 5000); //5s

    getVehiculeContrat();
    getDriverContrat();

    $('#table_body_driver_contrat tr').click(function (event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).trigger('click');
        }
    });

    $('#table_vehicule_contrat tr').click(function (event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).trigger('click');
        }
    });

    $('#btn-ajouter').click(function(){
        $('#formAddCar').modal('show');

        $('#camions').modal('hide');
    });

    $('#formStoreCar').submit(function (e){
        e.preventDefault();
        var formData = new FormData(this);
        var token = $('#_token').val();
        //Store Message
        fetch('/contrat/camion/ajouter',{
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
                        text: 'Camion ajouté avec succès',
                        icon: 'success',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            $('#formAddCar').modal('hide');
                            getVehiculeContrat();
                            $('#camions').modal('show');
                        }
                    });
                }
            });
    });

    //Update Camion
    $('#btn-update-camion').click(function (){

        var checkOffers = document.querySelectorAll('#cars_id');
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

            $('#camions').modal('hide');
            $('#formUpBody').remove();
            fetch('/contrat/camion/'+data[0].value)
                .then(response => response.json())
                .then(response => {
                    $('#formCar').
                        append(`
                              <div class="row" id="formUpBody">
                                 <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input
                                            type="text"
                                            name="registration_up"
                                            id="registration_up"
                                            required
                                            class="form-control"
                                            value="${response.registration}"
                                        />
                                       <input
                                            type="hidden"
                                            name="id_car_up"
                                            id="id_car_up"
                                            value="${response.id}"
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
                                            <option value="${response.type.id}" selected>${response.type.libelle}</option>

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
                                            <option value="${response.brand.id}" selected>${response.brand.libelle}</option>

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
                                            id="model_up"
                                            class="form-control"
                                            value="${response.model}"
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
                                            class="form-control"
                                            value="${response.payload}"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Charge utile (T)</label
                                        >
                                    </div>
                                </div>
                              </div>
                            `);

                    fetch('/type-car')
                        .then(response =>response.json())
                        .then(response =>{

                            response.forEach(item => {
                                $('#type_car_up').append(`
                                      <option value="${ item.id }" >${ item.libelle }</option>
                                `);
                            });
                        });

                    fetch('/brand-car')
                        .then(response =>response.json())
                        .then(response =>{
                            // console.log(response)
                            response.forEach(item => {
                                $('#brand_car_up').append(`
                                    <option value="${ item.id }" >${ item.libelle }</option>
                                `);
                            });
                        });
                });
            $('#formUpCar').modal('show');
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


    //update in bd
    $('#formUpdateCar').submit(function (e){
        e.preventDefault();
        var formData = new FormData(this);
        var token = $('#_tokenUp').val();
        fetch('/contrat/camion/modifier',{
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
                        text: 'Camion modifié avec succès',
                        icon: 'success',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            $('#formUpCar').modal('hide');
                            getVehiculeContrat();
                            $('#camions').modal('show');
                        }
                    });
                }
            });
    });

    $('#btn-delete-camion').click(function (){
        var checkOffers = document.querySelectorAll('#cars_id');
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

    $('#btn-select-camion').click(function(){

        var checkOffers = document.querySelectorAll('#cars_id');
        var data = [];

        // Verify if checkboxes are checked
        for(i=0; i < checkOffers.length; i ++){
            if(checkOffers[i].checked){
                data.push({
                    id:checkOffers[i].value,
                });
            }
        }

        data.forEach(item=>{
            fetch('/contrat/camion/'+item.id)
                .then(res => res.json())
                .then(res=>{
                    $('#car_wrapper').append(
                        `
                        <div class="col-12" >
                            <div class="form-group input-group mb-3">
                                <span class="input-group-text mr-5" id="remove_field_car">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                      <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </span>
                                <input class="form-control" type="hidden" value="${res.id}" id="id_car_contrat" name="id_car_contrat[]" >
                                <input class="form-control mr-5" type="text" value="${res.registration}" id="car_regis_contrat" name="car_regis_contrat[]"  readonly>
                                <input class="form-control mr-5" type="text" value="${res.type.libelle}" id="car_type_contrat" name="car_type_contrat[]"  readonly>
                                <input class="form-control" type="text" value="${res.brand.libelle}" id="car_brand_contrat" name="car_brand_contrat[]"  readonly>
                            </div>
                        </div>
                        `
                    );
                });
        });
        checkOffers.forEach(check=>{
            if(check.checked){
                check.checked = false;
            }
        })
        $('#camions').modal('hide');

    });
    $('#car_wrapper').on("click","#remove_field_car", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove();
    });

    //Conducteur
    $('#btn-add-driver').click(function (){
        $('#formAddDriver').modal('show');
        $('#conducteurs').modal('hide');
    });

    $('#formStoreDriver').submit(function (e){
        e.preventDefault();
        var formData = new FormData(this);
        var token = $('#_token_driver').val();

        //Store Message
        fetch('/contrat/conducteur/ajouter',{
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
                        text: 'Conducteur ajouté avec succès',
                        icon: 'success',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            $('#formAddDriver').modal('hide');
                            getDriverContrat();
                            $('#conducteurs').modal('show');
                        }
                    });
                }else {
                    Swal.fire({
                        title: "Erreur",
                        text: 'Une erreur s\'est produit lors de la création',
                        icon: 'error',
                    })
                }
            });
    });

    //Update conducteur
    $('#btn-update-driver').click(function (){

        var checkOffers = document.querySelectorAll('#drivers_id');
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

            $('#conducteurs').modal('hide');
            $('#formUpBodyDriver').remove();
            fetch('/contrat/conducteur/'+data[0].value)
                .then(response => response.json())
                .then(response => {
                    $('#formDriver').
                    append(`
                          <div class="row" id="formUpBodyDriver">
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input
                                            type="text"
                                            name="first_up"
                                            id="first_up"
                                            required
                                            class="form-control"
                                            value="${response.first_name}"
                                        />
                                          <input
                                            type="hidden"
                                            name="driver_id_up"
                                            id="driver_id_up"
                                            required
                                            class="form-control"
                                            value="${response.id}"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Nom <span class="text-danger">*</span></label
                                        >
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            type="text"
                                            name="last_up"
                                            id="last_up"
                                            required
                                            class="form-control"
                                            value="${response.last_name}"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Prénom <span class="text-danger">*</span></label
                                        >
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            type="text"
                                            name="permis_up"
                                            id="permis_up"
                                            required
                                            class="form-control"
                                            value="${response.licence}"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Numéro du permis de conduire <span class="text-danger">*</span></label
                                        >
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input
                                            type="date"
                                            name="date_permis_up"
                                            id="date_permis_up"
                                            class="form-control"
                                           value="${response.date_issue}"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Date d'établissement</label
                                        >
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            type="text"
                                            name="lieu_permis_up"
                                            id="lieu_permis_up"
                                            class="form-control"
                                            value="${response.place_issue}"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Lieu d'établissement</label
                                        >
                                    </div>
                                </div>
                          </div>
                        `);

                });
            $('#formUpDriver').modal('show');
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
    $('#formUpdateDriver').submit(function (e){
        e.preventDefault();
        var formData = new FormData(this);
        var token = $('#_token_driverUp').val();
        fetch('/contrat/conducteur/modifier',{
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
                        text: 'Conducteur modifié avec succès',
                        icon: 'success',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            $('#formUpDriver').modal('hide');
                            getDriverContrat();
                            $('#conducteurs').modal('show');
                        }
                    });
                }
            });
    });
    $('#btn-delete-driver').click(function (){
        var checkOffers = document.querySelectorAll('#drivers_id');
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
                    fetch('/contrat/conducteur/supprimer/'+item.value)
                        .then( response => response.json() )
                        .then( response => {
                            if(response == 0){
                                Swal.fire({
                                    title: 'Bravo',
                                    text: 'Le conducteur a été supprimée avec succès',
                                    icon: 'success',
                                });
                            } else if( response == 1){
                                Swal.fire({
                                    title: 'Erreur',
                                    text: 'Vous n\'êtes pas autorisé à supprimer le conducteur',
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
    $('#btn-select-driver').click(function(){

        var checkOffers = document.querySelectorAll('#drivers_id');
        var data = [];
        // Verify if checkboxes are checked
        for(i=0; i < checkOffers.length; i ++){

            if(checkOffers[i].checked){
                data.push({
                    id:checkOffers[i].value,
                });
            }
        }
        data.forEach(item=>{
            fetch('/contrat/conducteur/'+item.id)
                .then(res => res.json())
                .then(res=>{
                    $('#driver_wrapper').append(
                        `
                        <div class="col-12" >
                            <div class="form-group input-group mb-3">
                                <span class="input-group-text mr-5" id="remove_field_driver">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                      <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </span>
                                <input class="form-control" type="hidden" value="${res.id}" id="id_driver_contrat" name="id_driver_contrat[]" >
                                <input class="form-control mr-5" type="text" value="${res.licence}" id="driver_licence_contrat" name="driver_licence_contrat[]"  readonly>
                                <input class="form-control mr-5" type="text" value="${res.first_name}" id="driver_first_contrat" name="driver_first_contrat[]"  readonly>
                                <input class="form-control" type="text" value="${res.last_name}" id="driver_last_contrat" name="driver_last_contrat[]"  readonly>
                            </div>
                        </div>
                `
                    );

                });

        });
        checkOffers.forEach(check=>{
            if(check.checked){
                check.checked = false;
            }
        })
        $('#conducteurs').modal('hide');

    });
    $('#driver_wrapper').on("click","#remove_field_driver", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove();
    });

    // $('#formContrat').submit(function (e){
    //     e.preventDefault();
    //     var car_id = document.querySelectorAll('#id_car_contrat');
    //     var driver_id = document.querySelectorAll('#id_driver_contrat');
    //     var contrat_id = document.querySelector('#id_contrat');
    //     var token = document.querySelector('#_token_contrat');
    //
    //     if (car_id.length != driver_id.length){
    //         Swal.fire({
    //             icon: 'warning',
    //             title: 'Oops...',
    //             text: 'le nombre de camions est différent du nombre de conducteurs',
    //         });
    //     }else if(car_id.length == 0 || driver_id.length == 0){
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Oops...',
    //             text: 'Aucun camion ajouté ou aucun conducteur ajouté',
    //         });
    //     }else if (car_id.length == driver_id.length){
    //         var formData = new FormData(this);
    //         console.log('test');
            // car_id.forEach(item=>{
            //     formData.append( "car[]", JSON.stringify( item ) );
            // });
            // driver_id.forEach(item=>{
            //     formData.append( "driver[]", JSON.stringify( item ) );
            // });
            // formData.append( "car", JSON.stringify( car_id ) );
            // formData.append( "driver", JSON.stringify( driver_id ) );
            // let contrat = {id:contrat_id, car:car_id, driver:driver_id};
            // fetch('/contrat/modifier/contrat'
            //     , {
            //         headers: {
            //             // 'Accept': 'application/json',
            //             // 'Content-Type': 'application/json',
            //             "X-CSRF-Token": token
            //         },
            //         method: 'POST',
            //         }
            //     )
            //     .then(response =>
            //         response.json()
            //     )
                // .then(data =>{
                //         console.log(data);
                //         if(data == 0){
                //             Swal.fire({
                //                     icon: 'success',
                //                     title: 'Bravo',
                //                     text: 'les camions et les conducteurs sont ajoutés au contrat de transport',
                //                 }
                //             );
                //         }
                //     });
        // }

    //
    //     car_id.forEach(item =>{
    //         console.log(item.value);
    //     }) ;
    //     driver_id.forEach(item =>{
    //         console.log(item.value);
    //     });
    //     console.log(contrat_id.value)
    //     console.log(token.value)
    // });

    //Datatable vehicles contract
    async function getVehiculeContrat(){
        const records = await fetch('/vehicules/api').then((res)=>{ return res.json() }).then((res)=>{return res});

        let tab = '';
        records.forEach((obj)=>{
            tab+=`
                <tr>
                    <td>
                        <input type="checkbox" type="checkbox" name="cars_id" id="cars_id" value="${obj.id}">
                    </td>
                    <td id="cars_regis">${obj.registration} </td>
                    <td id="cars_type">${obj.fk_type.libelle} </td>
                    <td id="cars_brand">${obj.fk_brand.libelle} </td>
                </tr>
           `;
        });

        document.getElementById('table_body_cars').innerHTML = tab;
        $('#table_vehicule_contrat').DataTable({
            "data": records,
            columnDefs: [
                {
                    targets: 0
                }
            ],
            "columns":[
                {"data":'id',
                    render: (data, type, row) =>
                        '<input type="checkbox" type="checkbox" name="cars_id" id="cars_id" value="'+data+'">'
                },
                {"data":'registration'},
                {"data":'fk_type.libelle'},
                {"data":'fk_brand.libelle'},
            ],
            retrieve: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.7/i18n/fr-FR.json',
                "paginate": {
                    "previous": "<",
                    "next": ">",
                    "first": "",
                    "last": ""
                }
            }
        });


    }

    async function getDriverContrat(){
        const records = await fetch('/drivers/api').then((res)=>{ return res.json() }).then((res)=>{return res});

        let tab = '';
        records.forEach((obj)=>{
            tab+=`
                <tr>
                    <td>
                        <input type="checkbox" type="checkbox" name="drivers_id" id="drivers_id" value="${obj.id}">
                    </td>
                       <td id="drivers_licence">${obj.licence} </td>
                       <td id="drivers_first">${obj.first_name} </td>
                       <td id="drivers_last">${obj.last_name} </td>
                </tr>
           `;
        });

        document.getElementById('table_body_driver_contrat').innerHTML = tab;
        $('#table_driver_contrat').DataTable({
            "data": records,
            columnDefs: [
                {
                    targets: 0
                }
            ],
            "columns":[
                {"data":'id',
                    render: (data, type, row) =>
                        '<input type="checkbox" type="checkbox" name="drivers_id" id="drivers_id" value="'+data+'">'
                },
                {
                    "data": 'licence',
                },
                {
                    "data": 'first_name',
                },
                {
                    "data": 'last_name',
                }
            ],

            retrieve: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.7/i18n/fr-FR.json',
                "paginate": {
                    "previous": "<",
                    "next": ">",
                    "first": "",
                    "last": ""
                }
            }
        });


    }

});
