<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('src/dist/libs/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('src/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- apps -->
<script src="{{ asset('src/dist/js/app.min.js') }}"></script>
<script src="{{ asset('src/dist/js/app.init.mini-sidebar.js') }}"></script>
<script src="{{ asset('src/dist/js/app-style-switcher.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('src/dist/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.js') }}"></script>
<script src="{{ asset('src/dist/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('src/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('src/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('src/dist/js/feather.min.js') }}"></script>
<script src="{{ asset('src/dist/js/custom.min.js') }}"></script>
<script src="{{ asset('src/dist/js/pages/dashboards/dashboard1.js') }}"></script>
<script src="{{ asset('src/dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('src/dist/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('src/dist/js/pages/forms/select2/select2.init.js') }}"></script>
<script>

$(document).ready(function (){
    function setUserStatutFromSession(){
           fetch('/utilisateur/session/update');
    }

    setUserStatutFromSession();

    $('#table_vehicule tr').click(function (event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).trigger('click');
        }
    });

    setTimeout(function (){
        $('#remove').remove();
        fetch('/notifications')
            .then(response => response.json())
            .then(response =>{
                for( i=0; i < 3; i++){
                    const date = new Date(response[i].created_at)
                        .toLocaleString('en-GB', {
                        hour12: false,
                    });
                    var newRow = `
                <div id="remove">
                    <a
                        href="javascript:void(0)"
                        class="
                        message-item
                        d-flex
                        align-items-center
                        border-bottom
                        px-3
                        py-2
                      "
                    >
                      <span
                          class="user-img position-relative d-inline-block"
                      >
                        <img
                            src="{{ asset('src/assets/images/favicon.ico') }}"
                            alt="user"
                            class="rounded-circle w-100"
                        />
                        <span
                            class="profile-status rounded-circle online"
                        ></span>
                      </span>
                        <div class="w-75 d-inline-block v-middle ps-3">
                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                ${ response[i].action }
                            </h5>
                            <span
                                class="
                                    fs-2
                                    text-nowrap
                                    d-block
                                    time
                                    text-truncate
                                    fw-normal
                                    mt-1
                                  "
                            >
                                    ${ response[i].description }
                            </span
                            >
                            <span
                                class="
                                    fs-2
                                    text-nowrap
                                    d-block
                                    subtext
                                    text-muted
                                  "
                            >    ${date }</span
                            >
                        </div>
                    </a>
                </div>

                `;
                    $('#notif').append(newRow);
                }

            })
    }, 500)

    // Single Select Placeholder
    $("#lieu-depart").select2({
        placeholder: "Lieu de départ",
        allowClear: true,
    });
    $("#lieu-destination").select2({
        placeholder: "Lieu de destination",
        allowClear: true,
    });

    document.getElementById("btn-publier-offre").addEventListener("click",function (){

        var villesDepart = $('#origin');
        var villesArrive = $('#destination');
        var typeCar = $('#vehicule_type');
        //Get all villes
        fetch('/villes')
            .then(response => response.json())
            .then(data => {

                data.forEach(item => {
                    villesDepart.append(`
                   <option value="${ item.id }"> ${ item.libelle }</option>
                `)
                    villesArrive.append(`
                   <option value="${ item.id }"> ${ item.libelle }</option>
                `)
                })
            });
        //Get all type of car
        fetch('/type-car')
            .then(response => response.json())
            .then(data => {

                data.forEach(item => {
                    typeCar.append(`
                   <option value="${ item.id }"> ${ item.libelle }</option>
                `)
                })
            });
    });

    $("#table-camion").hide();
    $('#btn_add_camion').click(function (){
        $("#table-camion").show();

        getVehicule();
        $('#camion-liste').modal('show');

    });
    $("#btn-choisir-camion").click(function (){
        var checkOffers = document.querySelectorAll('#car-id-offer');
        var data = [];

        // Verify if checkboxes are checked
        checkOffers.forEach(event => {
            if(event.checked){
                data.push(event);
            }
        });

        if (data.length <= 0) {
            Swal.fire({
                title: 'Erreur',
                text: 'Aucune ligne sélectionnée',
                icon: 'error',
            });
        }else{
            data.forEach(obj=>{
                fetch('/contrat/camion/'+obj.value)
                    .then(res => res.json())
                    .then(res=>{
                        $("#table-list-vehicule").append(`
                            <tr>
                                <td>
                                    <input class="form-control" type="hidden" id="id_vehicule" name="id_vehicule[]" value="${res.id}" >
                                    <span class="input-group-text mr-5" id="removes_field_car">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </span>
                                </td>
                                <td>
                                    <input class="form-control" type="number" id="nb_vehicule" name="nb_vehicule[]" value="1" placeholder="Entrez le nombre de camion">
                                </td>
                                <td>
                                        <input
                                            type="textarea"
                                            class="form-control"
                                            value="${res.type.libelle+' / '+res.model}"
                                        />
                                </td>
                                <td> <input class="form-control mr-5" type="text" value="${res.payload}" readonly>
                                </td>
                            </tr>
                        `);
                    });
            });
        }

        $("#camion-liste").modal('hide');
    });
    async function getVehicule(){
       const records = await fetch('/vehicules/api').then((res)=>{ return res.json() }).then((res)=>{return res});
       let tab = '';
       records.forEach((obj)=>{
           tab+=`
                <tr>
                    <td>
                        <input type="checkbox" type="checkbox" name="car-id-offer" id="car-id-offer" value="${obj.id}">
                    </td>
                    <td>${obj.registration} </td>
                    <td>${obj.fk_type.libelle} </td>
                    <td>${obj.model} </td>
                    <td>${obj.fk_brand.libelle} </td>
                    <td>${obj.payload} </td>
                </tr>
           `;
       });

       document.getElementById('table_body').innerHTML = tab;
       $('#table_vehicule').DataTable({
           "data": records,
           columnDefs: [
               {
                   targets: 0
               }
           ],
           "columns":[
               {"data":'id',
                   render: (data, type, row) =>
                       '<input type="checkbox" type="checkbox" name="car-id-offer" id="car-id-offer" value="'+data+'">'
               },
               {"data":'registration'},
               {"data":'fk_type.libelle'},
               {"data":'model'},
               {"data":'fk_brand.libelle'},
               {"data":'payload'}
           ],
           retrieve: true,
       });

    }


    $('#table-list-vehicule').on("click","#removes_field_car", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('td').parent('tr').remove();
    });

});

</script>
