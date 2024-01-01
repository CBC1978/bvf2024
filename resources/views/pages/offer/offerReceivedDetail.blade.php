@extends('layouts.app')

@section('breadcumbs')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Mes offres de
                @php
                    if(Session::get('role') == env('ROLE_SHIPPER'))
                        { echo 'transports'; }
                    elseif(Session::get('role') == env('ROLE_CARRIER'))
                        { echo 'frets'; }
                @endphp
            </h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Les proposition d'offres de
                        @php
                            if(Session::get('role') == env('ROLE_SHIPPER'))
                                { echo 'transports'; }
                            elseif(Session::get('role') == env('ROLE_CARRIER'))
                                { echo 'frets'; }
                        @endphp
                        reçues
                    </a>
                </li>
            </ol>
        </div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <div class="d-flex mt-2 justify-content-end">
                <div class="d-flex me-3 ms-2">
                    <div class="chart-text me-2">
                        <h6 class="mb-0"><small>THIS MONTH</small></h6>
                        <h4 class="mt-0 text-info">$58,356</h4>
                    </div>
                    <div class="spark-chart">
                        <div id="monthchart"></div>
                    </div>
                </div>
                <div class="d-flex ms-2">
                    <div class="chart-text me-2">
                        <h6 class="mb-0"><small>LAST MONTH</small></h6>
                        <h4 class="mt-0 text-primary">$48,356</h4>
                    </div>
                    <div class="spark-chart">
                        <div id="lastmonthchart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3 col-sm-12" >
            <div class="card card-hover">
                <div class="card-header bg-dark">
                    <h4 class="mb-0 text-white text-center">
                    Détail sur l'offre de
                        @php
                            if(Session::get('role') == env('ROLE_SHIPPER'))
                                { echo 'fret'; }
                            elseif(Session::get('role') == env('ROLE_CARRIER'))
                                { echo 'transport'; }
                        @endphp
                    </h4>
                </div>
                <div class="card-body">
                    <h3 class="card-title text-center">Itineraire: {{ ucfirst($offer->origin->libelle) }}- {{ ucfirst($offer->destination->libelle) }}</h3>
                    <h3 class="card-title text-center">Date expiration: {{ date("d/m/Y",strtotime($offer->limit_date)) }}</h3>
                    <p class="card-text text-center">
                        {{ $offer->description }}
                    </p>
                    <div class="row mb-3">
                        <div class="text-center  mr-6">
                            <button
                                type="button"
                                class="btn btn-light-secondary text-secondary font-weight-medium">
                                {{ $offer->weight }}(T)
                            </button>
                        </div>
                        @if( isset($offer->vehicule_type) && !empty($offer->vehicule_type))
                            <div class="text-center">
                                <button
                                    type="button"
                                    class="btn btn-light-secondary text-secondary font-weight-medium">
                                    {{ $offer->vehicule_type->libelle}}
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="row mb-3 ">
                        @if(isset($offer->price) && !empty($offer->price))
                            <div class=" text-center mb-3">
                                <button
                                    type="button"
                                    class="btn btn-light-secondary text-secondary font-weight-medium">
                                    Prix: {{ $offer->price }} F
                                </button>
                            </div>
                        @endif
                        @if( isset($offer->volume) && !empty($offer->volume))
                            <div class="text-center">
                                <button
                                    type="button"
                                    class="btn btn-light-secondary text-secondary font-weight-medium">
                                    {{ $offer->volume }}m3
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12 lg-12 col-xxl-12 col-sm-12 col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row mb-3">
                        <div class="col-6">
                            <h4>Les propositions d'offres de
                                @php
                                    if(Session::get('role') == env('ROLE_SHIPPER'))
                                        { echo 'transports'; }
                                    elseif(Session::get('role') == env('ROLE_CARRIER'))
                                        { echo 'frets'; }
                                @endphp
                                reçues
                            </h4>
                        </div>
                        <div class="col-6">
                            <input type="text" class="w-100 form-control" id="recherche" placeholder="Recherchez une annonce">
                        </div>
                    </div>

                    <div class="row" >
                        @if( count($offer->offers) == env('DEFAULT_INT'))
                            <p>Aucune offre disponible</p>
                        @endif
                        @foreach($offer->offers as $offer)
                            <div class="col-md-4 col-sm-12" id="card_annonce">
                                <div class="card card-hover">
                                    <div class="card-header bg-{{$offer->color}}">
                                        <h4 class="mb-0 text-white">{{ $offer->company->company_name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            {{ $offer->description }}
                                        </p>
                                        <div class="row mb-3">
                                            @if(isset($offer->weight) && !empty($offer->weight))
                                                <div class="col-12 mr-6">
                                                    <button
                                                        type="button"
                                                        class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                        {{ $offer->weight }}(T)
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row mb-3">
                                            @if(isset($offer->price) && !empty($offer->price))
                                                <div class="col-12 mb-3">
                                                    <button
                                                        type="button"
                                                        class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                        Prix: {{ $offer->price }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="hidden" id="offer_id" value="{{$offer->id}}">
                                        <div class="row">
                                            <button id="btn-accepter" class="btn btn btn-rounded btn-outline-success">
                                                Accepter
                                            </button>
                                            <button id="btn-refuser" class="btn btn btn-rounded btn-outline-danger mb-2 mt-2" >
                                                Refuser
                                            </button>
                                            <button id="btn-discuter" class="btn btn btn-rounded btn-outline-warning"  >
                                                Discuter
                                                <span class="badge ms-auto bg-primary">1</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $("div.alert").remove();
            }, 5000); //5s

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


            $('#btn-discuter').click(function(){
                var offerId = $('#offer_id').val();
                window.location.href=  '/discussions?offer='+offerId;
            });

            $('#btn-accepter').click(function(){

                var offerId = $('#offer_id').val();
                fetch('/offre/statut/modifier/'+offerId+'/1')
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        location.reload();
                    });
                location.reload();
            });


            $('#btn-refuser').click(function(){

                var offerId = $('#offer_id').val();
                fetch('/offre/statut/modifier/'+offerId+'/2')
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        location.reload();
                    });
                location.reload();
            });
        });

    </script>

@endsection
