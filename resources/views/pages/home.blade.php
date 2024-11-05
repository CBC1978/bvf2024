@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{ asset('src/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection
@section('breadcumbs')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Accueil</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Offres récentes de
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
    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div
                            class="
                        round round-lg
                        text-white
                        d-flex
                        align-items-center
                        justify-content-center
                        rounded-circle
                        bg-info
                      "
                        >
                            <i
                                data-feather="credit-card"
                                class="fill-white feather-lg"
                            ></i>
                        </div>
                        <div class="ms-2 align-self-center">
                            <h3 class="mb-0">{{ $nbOffer }}</h3>
                            <h6 class="text-muted mb-0">Nombre d'offres</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div
                            class="
                        round round-lg
                        text-white
                        d-flex
                        align-items-center
                        justify-content-center
                        rounded-circle
                        bg-warning
                      "
                        >
                            <i
                                data-feather="monitor"
                                class="fill-white feather-lg"
                            ></i>
                        </div>
                        <div class="ms-2 align-self-center">
                            <h3 class="mb-0">{{ $nbOfferReceived }}</h3>
                            <h6 class="text-muted mb-0">Nombre d'offres reçus</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div
                            class="
                        round round-lg
                        text-white
                        d-flex
                        align-items-center
                        justify-content-center
                        rounded-circle
                        bg-primary
                      "
                        >
                            <i
                                data-feather="shopping-bag"
                                class="fill-white feather-lg"
                            ></i>
                        </div>
                        <div class="ms-2 align-self-center">
                            <h3 class="mb-0">{{$nbContract[0] }}</h3>
                            <h6 class="text-muted mb-0">Nombre de contrats</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div
                            class="
                        round round-lg
                        text-white
                        d-flex
                        justify-content-center
                        align-items-center
                        rounded-circle
                        bg-danger
                      "
                        >
                            <i
                                data-feather="shield"
                                class="fill-white feather-lg"
                            ></i>
                        </div>
                        <div class="ms-2 align-self-center">
                            <h3 class="mb-0">{{ $nbContract[1] }}</h3>
                            <h6 class="text-muted mb-0">Nombre de contrat ce mois</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
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
                            <h4>Les offrets récentes de
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
                                            <h3 class="card-title">Itineraire: {{ ($offer->origin)? ucfirst($offer->origin->libelle):'' }}- {{ ($offer->destination)? ucfirst($offer->destination->libelle):'' }}</h3>
                                            <h3 class="card-title">Date expiration: {{ date("d/m/Y",strtotime($offer->limit_date)) }}</h3>
                                            <p class="card-text">
                                                {{ $offer->description }}
                                            </p>
                                            <div class="row mb-2">
                                                @if(isset($offer->cars))
                                                    @foreach($offer->cars as $car)
                                                        <div class="row mb-3">
                                                            <div class="col-3 mr-2">
                                                                <button
                                                                    type="button"
                                                                    class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                                    {{$car->car->payload}}(T)
                                                                </button>
                                                            </div>
                                                            <div class="col-7">
                                                                <button
                                                                    type="button"
                                                                    class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                                    {{$car->car->model.' / '.$car->type->libelle}}
                                                                </button>
                                                            </div>
                                                            <div class="col-2">
                                                                <button
                                                                    type="button"
                                                                    class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                                    {{$car->qte}}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="row mb-3">
                                                        <div class="col-6 mr-2">
                                                            <button
                                                                type="button"
                                                                class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                                {{$offer->weight}}(T)
                                                            </button>
                                                        </div>
                                                        @if( isset($offer->volume) && !empty($offer->volume))
                                                            <div class="col-6">
                                                                <button
                                                                    type="button"
                                                                    class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                                    {{ $offer->volume }} m3
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif

                                                    <div class="row mb-3">
                                                        <div class="col-md-6 mb-3">
                                                            <button
                                                                type="button"
                                                                class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                                Prix: {{ $offer->price }} F
                                                            </button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button
                                                                type="button"
                                                                class="btn d-flex align-items-center btn-light-secondary d-block text-secondary font-weight-medium">
                                                                @if($offer->type_price == env('default_int'))
                                                                    Tarif/Tonne
                                                                @elseif($offer->type_price == env('status_valid'))
                                                                    Tarif/Camion
                                                                @endif
                                                            </button>
                                                        </div>
                                                    </div>
                                                    {{--                                                    @if(Session::get('fk_shipper_id') != env('DEFAULT_INT') && Session::get('status') >= env('DEFAULT_VALID'))--}}
                                                    <button class="btn btn btn-rounded btn-outline-success"  data-bs-toggle="modal" data-bs-target="#postuler-offre-{{$offer->id}}">
                                                        Postuler
                                                    </button>
                                                    {{--                                                    @elseif(Session::get('fk_carrier_id') != env('DEFAULT_INT') && Session::get('status') >= env('DEFAULT_VALID'))--}}
{{--                                                    <button class="btn btn btn-rounded btn-outline-success"  data-bs-toggle="modal" data-bs-target="#postuler-offre-{{$offer->id}}">--}}
{{--                                                        Postuler--}}
{{--                                                    </button>--}}
                                                    {{--                                                    @endif--}}
                                            </div>
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
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-floating mb-3">
                                                            <input
                                                                type="number"
                                                                step="0.01"
                                                                class="form-control"
                                                                placeholder="Prix"
                                                                name="price"
                                                                id="price"
                                                                required
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
                                                                type="textarea"
                                                                class="form-control"
                                                                placeholder="Description"
                                                                name="description"
                                                                id="description"
                                                                required
                                                            />
                                                            <label
                                                            ><i
                                                                    class="feather-sm text-dark fill-white me-2"
                                                                ></i
                                                                >Description <span class="text-danger">*</span></label
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-floating mb-3">
                                                            <input
                                                                type="number"
                                                                step="0.01"
                                                                class="form-control"
                                                                placeholder="Poids"
                                                                name="weight"
                                                                id="weight"
                                                                required
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
                                                                type="number"
                                                                class="form-control"
                                                                placeholder="Durée"
                                                                name="duration"
                                                                id="duration"
                                                                required
                                                            />
                                                            <label
                                                            ><i
                                                                    class="feather-sm text-dark fill-white me-2"
                                                                ></i
                                                                >Durée du trajet (jour(s)) <span class="text-danger">*</span></label
                                                            >
                                                        </div>
                                                    </div>




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

    {{-- Modal choisir entreprise--}}
    <div
        class="modal fade"
        id="choisir-entreprise"
        tabindex="-1"
        aria-labelledby="choisir-entreprise"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header d-flex align-items-center modal-colored-header bg-light text-white">
                    <div class="row">
                        <div class="col-4 top">
                            <button
                                type="button"
                                id="btn-select-obj"
                                class="
                                      justify-content-center
                                      w-300
                                      btn btn-rounded btn-outline-success
                                      d-flex
                                      align-items-center
                                    "
                            >
                                <i
                                    data-feather="plus-circle"
                                    class="feather-sm fill-white me-2"
                                ></i>
                                Sélectionner
                            </button>
                        </div>
                    </div>
                    <button
                        type="button"
                        class="btn-close bg-dark"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table
                            id="lang_file"
                            class="table table-striped table-bordered display"
                            style="width: 100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Adresse</th>
                                <th>Phone</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($entreprise)>0)
                                @foreach($entreprise as $obj)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="obj_id" id="obj_id" value="{{ $obj->id }}">
                                        </td>
                                        <td>
                                            {{$obj->company_name}}
                                        </td>
                                        <td>
                                            {{$obj->address}}
                                        </td>
                                        <td>
                                          {{$obj->phone}}
                                        </td>
                                        <td>
                                            {{$obj->email}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Adresse</th>
                                <th>Phone</th>
                                <th>Email</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- end Modal--}}
@endsection

@section('script')
    <script src="{{ asset('src/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>
    <script src="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                $("div.alert").remove();
            }, 5000); //5s

            setTimeout(function () {
                fetch('/affecter-utilisateur-entreprise')
                    .then(response=>response.json())
                    .then(response =>{
                        if(response == 0){
                            $('#choisir-entreprise').modal('show');
                        }
                    });
            }, 2000); //2s

            $('#lang_file tr').click(function (event) {
                if (event.target.type !== 'checkbox') {
                    $(':checkbox', this).trigger('click');
                }
            });

            $('#btn-select-obj').click(function (){

                var checkOffers = document.querySelectorAll('#obj_id');
                var data = [];

                // Verify if checkboxes are checked
                checkOffers.forEach(event => {
                    if(event.checked){
                        data.push(event);
                    }
                });

                if(data.length == 0){
                    Swal.fire({
                        title: 'Erreur',
                        text: 'Aucune ligne sélectionnée',
                        icon: 'error',
                    });
                }

                if( data.length == 1){

                    fetch('/affecter-utilisateur/'+data[0].value)
                        .then(response => response.json())
                        .then(response => {
                            Swal.fire({
                                title: 'Succès',
                                text: 'Votre demande a été traité avec succès',
                                icon: 'success',
                            });
                            setTimeout(function () {
                                $('#choisir-entreprise').modal('hide');
                            }, 3000); //3s
                        });
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
