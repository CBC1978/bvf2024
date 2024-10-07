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
                    <div class="row">
                        <div class="text-center  mr-6 mb-3">
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
                            <div class="text-center mb-3">
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
                                        <h4 class="mb-0 text-white">{{ $offer->company }}</h4>
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
                                            @if(isset($offer->duration) && !empty($offer->duration))
                                                <div class="col-12 mr-6">
                                                    <p>
                                                        <span> Durée du trajet jour(s) : </span>
                                                        <input
                                                            id="duration-{{$offer->id}}"
                                                            value ="{{ $offer->duration }}"
                                                            type="text"
                                                            class="btn d-flex w-25 align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                    </p>
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
                                        <div class="row">
                                            <input type="button" class=" btn btn-rounded accepter btn-outline-success" id="{{$offer->id}}" value="Accepter">
                                            <input type="button" class=" btn btn-rounded refuser btn-outline-danger mb-2 mt-2" id="{{$offer->id}}" value="Refuser">
                                            <input type="button" class=" btn btn-rounded discuter btn-outline-warning" id="{{$offer->id}}" value="Discuter">
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
    <script src="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('resources/js/bvf/offer/detail.js') }}"></script>
@endsection
