$(document).ready(function () {
    setTimeout(function () {
        $("div.alert").remove();
    }, 5000); //5s

    $('#lang_file tr').click(function (event) {
        if (event.target.type !== 'checkbox') {
            $(':checkbox', this).trigger('click');
        }
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
                                    text: 'Impossible de supprimer une offre déjà acceptée',
                                    icon: 'error',
                                });
                            }
                        });
                });
                setTimeout(function () {
                    location.reload();
                }, 3000); //3s
                //refresh page
            }
        });
    });
});
