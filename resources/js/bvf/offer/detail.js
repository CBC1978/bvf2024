$(document).ready(function () {
    setTimeout(function () {
        $("div.alert").remove();
    }, 4000); //4s

    var searchInput = document.querySelector('input[id^="recherche"]');
    $(searchInput).keyup(function () {
        var filter, allAnnonces;
        filter = searchInput.value.toUpperCase();
        allAnnonces = document.querySelectorAll('#card_annonce');
        allAnnonces.forEach(item => {
            itemValue = item.innerText;
            if (itemValue.toUpperCase().indexOf(filter) > -1) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });


    $('.discuter').click(function(btn){
        var offerId = btn.target.attributes.id.value;
        window.location.href=  '/discussions?offer='+offerId;
    });

    $('.accepter').click(function(btn){

        var offerId = btn.target.attributes.id.value;
        var duration = $('#duration-'+offerId).val();

        Swal.fire({
            title: 'Infos',
            text: 'Votre requête est en cours de traitement',
            icon: 'info',
        });

        fetch('/offre/statut/modifier/'+offerId+'/1/'+duration)
            .then(response => response.json())
            .then(data=>{
                Swal.fire({
                    title: 'Succès',
                    text: 'Offre acceptée avec succès',
                    icon: 'success',
                });
                setTimeout(function () {
                    location.reload();
                }, 3000); //3s
            });
    });

    $('.refuser').click(function(btn){

        Swal.fire({
            title: 'Infos',
            text: 'Votre requête est en cours de traitement',
            icon: 'info',
        });
        var offerId = btn.target.attributes.id.value;
        fetch('/offre/statut/modifier/'+offerId+'/2'+duration)
            .then(response => response.json())
            .then(data=>{
                Swal.fire({
                    title: 'Succès',
                    text: 'Offre réfusée avec succès',
                    icon: 'success',
                });
                setTimeout(function () {
                    location.reload();
                }, 3000); //3s
            });
    });
});
