@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('src/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <style>
        @media screen and  (min-width: 100px) and  (max-width: 768px){
            .top{
                margin-top:5px;
            }
        }
    </style>
@endsection
@section('breadcumbs')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Mon contrat de transport</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                </li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12" >
            <div class="card card-hover">
                <div class="card-header bg-dark ">
                    <h4 class="mb-0 text-white" >
                        Contrat de transport
                    </h4>
                    <form id="formContrat">
                        @csrf
                        <button
                            style="float: right; margin-top: -25px;"
                            type="submit"
                            class="
                            btn btn-info
                            font-weight-medium
                            rounded-pill
                            px-4
                            text-right
                            "
                            id="btn-contrat-save"
                        >
                            <div class="d-flex align-items-center">
                                <i
                                    data-feather="send"
                                    class="feather-sm fill-white me-2"
                                ></i>
                                Enregistrer
                            </div>
                        </button>
                        <input type="hidden" name="contract" id="id_contrat" name="id_contrat" value="1">
                        <input type="hidden" value="{{ csrf_token() }}" id="_token_contrat" name="_token_contrat">

                </div>
                <div class="card-body">
                    <h3 class="card-title text-left">D'une part, Company 1</h3>
                    <h3 class="card-title text-left">D'autre part</h3>
                    <p class="card-text text-center">
                       Il est convenu le transport de marchandise sur l'itinéraire A-B avec les détails suivants:
                    </p>
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
            <div class="card card-hover">
                <div class="card-header bg-info text-white">
                        Ajouter les camions concernées
                        <button
                            id="btn-table-car"
                            type="button"
                            class="
                            btn
                            d-inline-flex
                            align-items-center
                            justify-content-center
                            text-white
                            "
                            data-bs-toggle="modal" data-bs-target="#camions"
                        >
                        <i data-feather="plus-circle" class="feather-sm fill-white"></i>
                        </button>

                </div>
                <div class="card-body row" id="car_wrapper">
                    @if(isset($contrat->detail) && !empty($contrat->detail))
                        @foreach($contrat->detail as $ct)
                            <div class="col-12" >
                                <div class="form-group input-group mb-3">
                                    <span class="input-group-text mr-5" id="remove_field_car">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </span>
                                    <input class="form-control" type="hidden" value="{{$ct->car->id}}" id="id_car_contrat" name="id_car_contrat[]" >
                                    <input class="form-control mr-5" type="text" value="{{$ct->car->registration}}" id="car_regis_contrat" name="car_regis_contrat[]"  readonly>
                                    <input class="form-control mr-5" type="text" value="{{$ct->car->type->libelle}}" id="car_type_contrat" name="car_type_contrat[]"  readonly>
                                    <input class="form-control" type="text" value="{{$ct->car->brand->libelle}}" id="car_brand_contrat" name="car_brand_contrat[]"  readonly>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="card card-hover">
                <div class="card-header bg-info text-white">
                    Ajouter les conducteurs concernés
                    <button
                        type="button"
                        class="
                        btn
                        d-inline-flex
                        align-items-center
                        justify-content-center
                        text-white
                        "
                        data-bs-toggle="modal" data-bs-target="#conducteurs"
                    >
                        <i data-feather="plus-circle" class="feather-sm fill-white"></i>
                    </button>
                </div>
                <div class="card-body row" id="driver_wrapper">
                    @if(isset($contrat->detail) && !empty($contrat->detail))
                        @foreach($contrat->detail as $contrat)
                            <div class="col-12" >
                                <div class="form-group input-group mb-3">
                                    <span class="input-group-text mr-5" id="remove_field_driver">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </span>
                                    test
                                    <input class="form-control" type="hidden" value="{{$contrat->driver->id}}" id="id_driver_contrat" name="id_driver_contrat[]" >
                                    <input class="form-control mr-5" type="text" value="{{$contrat->driver->licence}}" id="driver_licence_contrat" name="driver_licence_contrat[]"  readonly>
                                    <input class="form-control mr-5" type="text" value="{{$contrat->driver->first_name}}" id="driver_first_contrat" name="driver_first_contrat[]"  readonly>
                                    <input class="form-control" type="text" value="{{$contrat->driver->last_name}}" id="driver_last_contrat" name="driver_last_contrat[]"  readonly>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            </form>

            @include('pages.contrat.modal_update')
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('src/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>
    <script src="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('resources/js/bvf/contrat/update.js') }}"></script>

@endsection
