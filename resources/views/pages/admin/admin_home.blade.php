@extends('layouts.admin.app')

@section('breadcumbs')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Accueil administrateur</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
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
<h3>Offres récentes de transport</h3>
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
                        <h3 class="mb-0">{{ $nbOfferT }}</h3>
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
                        <h3 class="mb-0">{{ $nbOfferReceivedT }}</h3>
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
                        <h3 class="mb-0">$1795</h3>
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
                        <h3 class="mb-0">$687</h3>
                        <h6 class="text-muted mb-0">Nombre de contrat ce mois</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<h3>Offres récentes de fret</h3>
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
                        <h3 class="mb-0">$1795</h3>
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
                        <h3 class="mb-0">$687</h3>
                        <h6 class="text-muted mb-0">Nombre de contrat ce mois</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
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
