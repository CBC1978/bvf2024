<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrat de transport</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</head>

<body>
<div class="container-fluid">
    <div class="card-header text-center" style="background-color: lightskyblue;">
        <h2>BOURSE VIRTUELLE DE FRET</h2></br>
{{--        <h5>CONTRAT DE TRANSPORT N°{{ $contractCode }}</h5>--}}
    </div>



    </div>


    <br>
    <p class="fw-bold">LES SOUSSIGNES :</p>
    <p>
        La société {{ $info[0]->carrierName }} dont le siège social est à {{ $info[0]->carrierAddress }},
        immatriculé sous le RCCM {{$info[0]->carrierRccm}}, représentée par son gérant {{ strtoupper($info[0]->bossCarrierName) }},
        agissant en vertu des pouvoirs qui lui sont conférés, ci-après dénommé le
        « Transporteur, propriétaire du moyen de transport ».
    </p>
    <p>Et La société</p>
    <p>
        La société {{$info[0]->shipperName}}, dont le siège social est à {{ $info[0]->shipperAddress }},
        immatriculé sous le RCCM {{$info[0]->shipperRccm}}, représentée par son gérant {{ strtoupper($info[0]->bossShipperName) }},
        agissant en vertu des pouvoirs qui lui sont conférés, ci-après dénommé le
        « Chargeur, donneur d’ordre ou ayant droit de la cargaison ».
    </p>
    <p>ONT CONVENU ET ARRETE CE QUI SUIT :</p>
    <p>Article 1 : Objet du contrat </p>
    <p>
        <ul>
            <li>Fret : {{$info[0]->nature}}</li>
            <li>Moyens de transport :
                @if(isset($details) && !empty($details))
                    @foreach($details as $detail)
                        <ul>
                            <li>Véhicule : {{$detail->brand->libelle.' '.$detail->car_registration}} </li>
                            <li>Description : {{ $detail->type->libelle}}</li>
                        </ul>
                    @endforeach
                @endif
            </li>
            <li>Destination : {{$info[0]->origin->libelle.' à '. $info[0]->destination->libelle }}</li>
        </ul>
    </p>
    <p>Article 2 : Engagement du transporteur</p>
    <p>
        Le transporteur déclare avoir parfaite connaissance de la réglementation en vigueur applicable au transport
        et notamment celle concernant le type de cargaison transportée. Le propriétaire du moyen de transport
        reconnait expressément avoir toutes les autorisations requises ainsi que des documents obligatoires à jour
        pour fournir sa prestation. En outre il s’engage à livrer les marchandises dans les délais et conditions convenus.
    </p>

    <p>Article 3 : Engagement du chargeur</p>

    <p>
        Le chargeur s’engage à remettre la marchandise au transporteur en lui fournissant les informations,
        instructions et documents nécessaires à la réalisation de sa mission et pour les formalités de douane.
        Il s’engage notamment à payer le prix du transport convenu et s’acquitter des frais liés à une éventuelle immobilisation du véhicule.

    </p>
</br>
</br>
</br>
    <p>Article 4 : Date d’effet/ Durée/Résiliation</p>
      <p> Le présent contrat prend effet à compter de la date de validation par les deux parties.</p>
    <p>
        Article 5 : Rémunération
    </p>
    <p>
        Le présent contrat est conclu moyennent une rémunération forfaitaire à raison de tout transport
        dûment effectué. Il est entendu que les prix de transport sont fixés en commun accord entre
        le transporteur et le chargeur conformément à la réglementation en vigueur.
    </p>
    <p>Article 6 : autres informations</p>
    <p>
        Les autres clauses convenues entre les parties font partie intégrante du présent contrat.
        Le cas échéant elles sont précisées dans le présent article.
    </p>
    <p class="text-right">
        Fait à ................................................. le ...../...../.....
    </p>
    </p>
</br>
</br>
</br>
    <p>Article 4 : Date d’effet/ Durée/Résiliation</p>
      <p> Le présent contrat prend effet à compter de la date de validation par les deux parties.</p>
    <p>
        Article 5 : Rémunération
    </p>
    <p>
        Le présent contrat est conclu moyennent une rémunération forfaitaire à raison de tout transport
        dûment effectué. Il est entendu que les prix de transport sont fixés en commun accord entre
        le transporteur et le chargeur conformément à la réglementation en vigueur.
    </p>
    <p>Article 6 : autres informations</p>
    <p>
        Les autres clauses convenues entre les parties font partie intégrante du présent contrat.
        Le cas échéant elles sont précisées dans le présent article.
    </p>

    <p class="text-right">
        Généré par la bourse virtuelle de fret du CBC Le {{ $validationDate ?? '...../...../.....' }}
    </p>
    <p class="text-center">Ont signé</p>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>


                <th>Transporteur : {{ $info[0]->carrierName }}</th>
                <th>Chargeur : {{ $info[0]->shipperName }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <img src = "{{asset('public/images/signatures/'.$info[0]->carrierSignature)}}" alt="signature" width="300"  class="rounded mx-auto d-block img-fluid img-thumbnail" >
                </td>
                <td>
                    <img src = "{{asset('public/images/signatures/'.$info[0]->shipperSignature)}}" alt="signature" width="300"  class="rounded mx-auto d-block img-fluid img-thumbnail" >
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>{{ strtoupper($info[0]->bossCarrierName) }}</td>
                <td>{{ strtoupper($info[0]->bossShipperName) }}</td>
            </tr>
        </tfoot>
    </table>
</div>
</body>

</html>
