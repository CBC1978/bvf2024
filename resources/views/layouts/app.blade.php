@if(null != Session::has('userId') )
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
                        @if(Session('role') == env('ROLE_SHIPPER'))
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
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Date d'expiration <span class="text-danger">*</span> </label
                                            >
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
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
                                            <div class="col-3">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type_price"  value="0">
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Tonne
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type_price" value="1" checked>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Camion
                                                    </label>
                                                </div>
                                            </div>
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
                        @elseif(Session('role') == env('ROLE_CARRIER'))
                            <form method="post" action="{{ route('storePublishOffer') }}" >
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <select
                                                name="origin"
                                                id="origin"
                                                class="form-control"
                                                style="width: 100%; height: 36px"
                                            >
                                                <option disabled selected>Choisir une ville</option>
                                            </select>
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Lieu de départ </label
                                            >
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input
                                                type="date"
                                                name="limit_date"
                                                id="limit_date"
                                                required
                                                class="form-control"
                                            />
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Date d'expiration <span class="text-danger">*</span> </label
                                            >
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <select
                                                name="destination"
                                                id="destination"
                                                class="form-control"
                                                style="width: 100%; height: 36px"
                                            >
                                                <option disabled selected>Choisir une ville</option>
                                            </select>
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Lieu de destination</label
                                            >
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-floating mb-3">
                                                    <input
                                                        type="number"
                                                        step="0.01"
                                                        name="price"
                                                        id="price"
                                                        class="form-control"
                                                        placeholder="Prix"
                                                    />
                                                    <label
                                                    ><i
                                                            class="feather-sm text-dark fill-white me-2"
                                                        ></i
                                                        >Prix</label
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-3">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type_price"  value="0">
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Tonne
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type_price" value="1" checked>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Camion
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2 mb-3">
                                            <button
                                                type="button"
                                                class="
                                                  justify-content-center
                                                  w-100
                                                  btn btn-rounded btn-outline-success
                                                  d-flex
                                                  align-items-center
                                                "
                                                id="btn_add_camion"
                                            >
                                                <i
                                                    data-feather="plus-circle"
                                                    class="feather-sm fill-white me-2"
                                                ></i>
                                            </button>
                                        </div>
                                        <div>
                                            <div class="table-responsive">
                                                <table
                                                    id="table-camion"
                                                    class="table table-striped table-bordered display"
                                                    style="width: 100%">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nombre camion</th>
                                                        <th>Caractéristique</th>
                                                        <th>Charge utilte (T)</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="table-list-vehicule">

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nombre camion</th>
                                                        <th>Caractéristique</th>
                                                        <th>Charge utilte (T)</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

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
                        @endif
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- end Modal --}}


        {{-- Modal for vehicule offre--}}
        <div
            class="modal fade"
            id="camion-liste"
            tabindex="-1"
            aria-labelledby="camion-liste"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                        <h4 class="modal-title" id="myLargeModalLabel">
                            Liste des camions
                        </h4>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table
                                id="table_vehicule"
                                class="table table-striped table-bordered display"
                                style="width: 100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Immatriculation</th>
                                    <th>Type</th>
                                    <th>Modèle</th>
                                    <th>Marque</th>
                                    <th>Charge utilte (T)</th>
                                </tr>
                                </thead>
                                <tbody id="table_body">

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Immatriculation</th>
                                    <th>Type</th>
                                    <th>Modèle</th>
                                    <th>Marque</th>
                                    <th>Charge utilte (T)</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button
                            id="btn-choisir-camion"
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
                                Sélectionner
                            </div>
                        </button>
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
    <script type="text/javascript">
        window.location = "{ url('/index') }";//here double curly bracket
    </script>
@endif
