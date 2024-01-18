@if(Session::has('userId'))
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    @include('layouts.partials.head')
    @yield('head')
</head>

<body>
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
                                                type="number"
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
