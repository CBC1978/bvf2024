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
<!--This page JavaScript -->
<script src="{{ asset('src/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('src/dist/js/pages/dashboards/dashboard1.js') }}"></script>
<script src="{{ asset('src/dist/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('src/dist/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('src/dist/js/pages/forms/select2/select2.init.js') }}"></script>
<script>
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

</script>
