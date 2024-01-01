@if(Session::has('userId'))
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    @include('layouts.partials.head')
    @yield('head')
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <svg
        class="tea lds-ripple"
        width="37"
        height="48"
        viewbox="0 0 37 48"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <path
            d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z"
            stroke="#1e88e5"
            stroke-width="2"
        ></path>
        <path
            d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34"
            stroke="#1e88e5"
            stroke-width="2"
        ></path>
        <path
            id="teabag"
            fill="#1e88e5"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"
        ></path>
        <path
            id="steamL"
            d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke="#1e88e5"
        ></path>
        <path
            id="steamR"
            d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13"
            stroke="#1e88e5"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        ></path>
    </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    @include('layouts.partials.nav')
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    @include('layouts.partials.sidebar')
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        @yield('breadcumbs')
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            @yield('content')
        </div>

        {{-- Modal for publier offre--}}
        <div
            class="modal fade"
            id="publier-offre"
            tabindex="-1"
            aria-labelledby="publier-offre"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Ajouter une offre
                        </h4>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="card-title mb-3">Faites une offre</h4>
                        <form method="post" action="{{ route('storePublishOffer') }}" >
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <select
                                            name="origin"
                                            id="origin"
                                            class="form-control"
                                            required
                                            style="width: 100%; height: 36px"
                                        >
                                            <option disabled selected>Choisir une ville</option>
                                        </select>
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Lieu de départ <span class="text-danger">*</span> </label
                                        >
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            type="date"
                                            name="limit_date"
                                            id="limit_date"
                                            required
                                            class="form-control"
                                            placeholder="Date"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Date d'expiration <span class="text-danger">*</span></label
                                        >
                                    </div>
                                    @if(Session::get('role') == env('ROLE_SHIPPER'))
                                        <div class="form-floating mb-3">
                                            <input
                                                type="text"
                                                name="volume"
                                                id="volume"
                                                class="form-control"
                                                placeholder="Volume"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Volume (m3)</label
                                            >
                                        </div>
                                    @endif
                                </div>

                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <select
                                            name="destination"
                                            id="destination"
                                            class="form-control"
                                            required
                                            style="width: 100%; height: 36px"
                                        >
                                            <option disabled selected>Choisir une ville</option>
                                        </select>
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Lieu de destination<span class="text-danger">*</span></label
                                        >
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            type="number"
                                            step="0.01"
                                            name="weight"
                                            id="weight"
                                            required
                                            class="form-control"
                                            placeholder="Poids"
                                        />
                                        <label
                                        ><i
                                                class="feather-sm text-dark fill-white me-2"
                                            ></i
                                            >Poids(T)<span class="text-danger">*</span></label
                                        >
                                    </div>
                                    @if(Session::get('role') == env('ROLE_SHIPPER'))
                                        <div class="form-floating mb-3">
                                            <input
                                                type="number"
                                                step="0.01"
                                                name="price"
                                                id="price"
                                                required
                                                class="form-control"
                                                placeholder="Prix"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Prix<span class="text-danger">*</span></label
                                            >
                                        </div>
                                    @endif
                                    @if(Session::get('role') == env('ROLE_CARRIER'))
                                        <div class="form-floating mb-3">
                                            <select
                                                name="vehicule_type"
                                                id="vehicule_type"
                                                class="form-control"
                                                required
                                                style="width: 100%; height: 36px"
                                            >
                                                <option disabled selected>Choisir un type d'engin</option>

                                            </select>
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Type d'engin<span class="text-danger">*</span></label
                                            >
                                        </div>
                                    @endif
                                </div>
                                <div class="form-floating mb-3">
                                    <input
                                        type="textarea"
                                        name="description"
                                        id="description"
                                        required
                                        class="form-control"
                                        placeholder="Description"
                                    />
                                    <label
                                    ><i
                                            class="feather-sm text-dark fill-white me-2"
                                        ></i
                                        >Description (Précisez la nature de la marchandise)<span class="text-danger">*</span></label
                                    >
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
                                            Publier
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
        {{-- end Modal --}}
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        @include('layouts.partials.footer')
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- customizer Panel -->
<!-- ============================================================== -->
@include('layouts.partials.settings')
@include('layouts.partials.script')
@yield('script')
</body>
</html>
@else
   {{ Redirect::to('index') }}
@endif
