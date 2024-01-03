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
    <div class="card-header text-center" >Contrat de transport</div>
    <br>
    <p>Entre les soussignés</p>
    <p>
        La société {{$info[0]->shipperName}} dont le siège social est à {{ $info[0]->shipperAddress }}, immatriculé sous le RCCM
        {{$info[0]->shipperRccm}}
    </p>
    <p>ET</p>
    <p>
        La société {{ $info[0]->carrierName }} dont le siège social est à {{ $info[0]->carrierAddress }}
        immatriculé sous le RCCM {{$info[0]->carrierRccm}}
    </p>
    <p>Il a été convenu et arrêté ce qui suit :</p>
    <p>Article 1 : La société {{$info[0]->shipperName}} délègue par la présente société {{ $info[0]->carrierName }}, qui accepte,
        son pouvoir pour toutes les opérations de transit, de manutention, transport et de dédouanement de tous marchandises qu’il confie à l’importation ou à l’exportation.</p>
    <p>Article 2 : La société {{$info[0]->shipperName}} s’engage à mettre à la disposition {{ $info[0]->carrierName }} tous les documents relatifs au transit, de manutention, transport et le dédouanement
        Informer le nom du navire et la date probable de l’embarquement des marchandises et remettre les connaissements aussitôt qu’ils seront en sa possession.
    </p>
    <p>Article 3 : A cet effet {{ $info[0]->carrierName }} met à la disposition de {{$info[0]->shipperName}} qui accepte, un parc de @if(!empty($details)) {{ count($details) }} @else 0 @endif camions composé comme suit :</p>

    @if(!empty($details))
        @foreach($details as $detail)
            <p>{{ $detail->car_registration}}</p>
        @endforeach
    @endif
    <p>Article 4 : Le présent contrat conclu commence à courir dès la date de sa signature par les parties
        Il est renouvelable par tacite reconduction à la charge pour la partie qui entend résilier d’aviser l’autre (03) mois avant le terme normal.
    </p>
    <p class="text-right">
        Fait à Ouagadougou le {{ date("d/m/Y") }}
    </p>
    <p class="text-center">Ont signé</p>
    <p style="margin-bottom: 0px;">
        <span style="margin-right: 35%;" >{{$info[0]->carrierName}}</span>
        <span style="" >Pour {{ $info[0]->shipperName }}</span>
    </p>
    <p>
        <span style="margin-right: 30%;" >(Lu et Approuvé)</span>
        <span>(Lu et Approuvé)</span>
    </p>
</div>
</body>

</html>
