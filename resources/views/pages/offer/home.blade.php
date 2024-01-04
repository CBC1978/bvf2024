@extends('layouts.app')

@section('breadcumbs')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Accueil</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Offres de
                        @php
                            if(Session::get('role') == env('ROLE_SHIPPER'))
                                { echo 'transports'; }
                            elseif(Session::get('role') == env('ROLE_CARRIER'))
                                { echo 'frets'; }
                        @endphp
                    </a>
                </li>
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
        <div class="col-12 lg-12 col-xxl-12 col-sm-12 col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row mb-3">
                        <div class="col-6">
                            <h4>Toutes Les offrets de
                                @php
                                    if(Session::get('role') == env('ROLE_SHIPPER'))
                                        { echo 'transports'; }
                                    elseif(Session::get('role') == env('ROLE_CARRIER'))
                                        { echo 'frets'; }
                                @endphp
                            </h4>
                        </div>
                        <div class="col-6">
                            <input type="text" class="w-100 form-control" id="recherche" placeholder="Recherchez une annonce">
                        </div>
                    </div>

                    <div class="row" >
                        @if( count($offers) == env('DEFAULT_INT'))
                            <p>Aucune offre disponible</p>
                        @endif
                        @foreach($offers as $offer)
                            <div class="col-md-4 col-sm-12" id="card_annonce">
                                <div class="card card-hover">
                                    <div class="card-header bg-info">
                                        <h4 class="mb-0 text-white">{{ $offer->company_name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title">Itineraire: {{ ucfirst($offer->origin) }}- {{ ucfirst($offer->destination) }}</h3>
                                        <h3 class="card-title">Date expiration: {{ date("d/m/Y",strtotime($offer->limit_date)) }}</h3>
                                        <p class="card-text">
                                            {{ $offer->description }}
                                        </p>
                                        <div class="row mb-3">
                                            <div class="col-3 mr-6">
                                                <button
                                                    type="button"
                                                    class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                    {{ $offer->weight }}(T)
                                                </button>
                                            </div>
                                            @if( isset($offer->vehicule_type) && !empty($offer->vehicule_type))
                                                <div class="col-9">
                                                    <button
                                                        type="button"
                                                        class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                        {{ $offer->vehicule_type }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row mb-3">
                                            @if(isset($offer->price) && !empty($offer->price))
                                                <div class="col-md-4 mb-3">
                                                    <button
                                                        type="button"
                                                        class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                        Prix: {{ $offer->price }}
                                                    </button>
                                                </div>
                                            @endif
                                            @if( isset($offer->volume) && !empty($offer->volume))
                                                <div class="col-md-9">
                                                    <button
                                                        type="button"
                                                        class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                        {{ $offer->volume }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                        @if(Session::get('fk_shipper_id') != env('DEFAULT_INT'))
                                            <button class="btn btn btn-rounded btn-outline-success"  data-bs-toggle="modal" data-bs-target="#postuler-offre-{{$offer->id}}">
                                                Postuler
                                            </button>
                                            @elseif(Session::get('fk_carrier_id') != env('DEFAULT_INT'))
                                            <button class="btn btn btn-rounded btn-outline-success"  data-bs-toggle="modal" data-bs-target="#postuler-offre-{{$offer->id}}">
                                                Postuler
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Modal--}}
                            <div
                                class="modal fade"
                                id="postuler-offre-{{$offer->id}}"
                                tabindex="-1"
                                aria-labelledby="postuler-offre-{{$offer->id}}"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content ">
                                        <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                                            <h4 class="modal-title" id="myLargeModalLabel">
                                                Postuler à l'offre
                                            </h4>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <div class="modal-body">
                                            <h4 class="card-title">Faites une proposition</h4>
                                            <h5 class="card-subtitle mb-3 pb-3 border-bottom">
                                                Entrer des informations claires et valides
                                            </h5>
                                            <form method="post"  action="{{ route('storeApplyOffer') }}">
                                                @csrf
                                                <input type="hidden" name="offerId" id="offerId" value="{{ $offer->id }}">
                                                <div class="form-floating mb-3">
                                                    <input
                                                        type="number"
                                                        step="0.01"
                                                        class="form-control"
                                                        placeholder="Prix"
                                                        name="price"
                                                        id="price"
                                                    />
                                                    <label
                                                    ><i
                                                            class="feather-sm text-dark fill-white me-2"
                                                        ></i
                                                        >Prix <span class="text-danger">*</span></label
                                                    >
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input
                                                        type="number"
                                                        step="0.01"
                                                        class="form-control"
                                                        placeholder="Poids"
                                                        name="weight"
                                                        id="weight"
                                                    />
                                                    <label
                                                    ><i
                                                            class="feather-sm text-dark fill-white me-2"
                                                        ></i
                                                        >Poids(T)<span class="text-danger">*</span></label
                                                    >
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input
                                                        type="textarea"
                                                        class="form-control"
                                                        placeholder="Description"
                                                        name="description"
                                                        id="description"
                                                    />
                                                    <label
                                                    ><i
                                                            class="feather-sm text-dark fill-white me-2"
                                                        ></i
                                                        >Description <span class="text-danger">*</span></label
                                                    >
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
                                                        >
                                                            <div class="d-flex align-items-center">
                                                                <i
                                                                    data-feather="send"
                                                                    class="feather-sm fill-white me-2"
                                                                ></i>
                                                                Postuler
                                                            </div>
                                                        </button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            {{-- end Modal--}}
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
        });

    </script>

@endsection
