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
        <h3 class="text-themecolor mb-0">Signatures</h3>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active">
              Signature
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
    <div class="col-12">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">
                    <div class="row">
                        <div class="col-md-2 col-sm-12 top">
                            <button
                                type="button"
                                id="btn-add-signature"
                                class="
                                      justify-content-center
                                      w-100
                                      btn btn-rounded btn-outline-success
                                      d-flex
                                      align-items-center
                                    "
                            >
                                <i
                                    data-feather="plus-circle"
                                    class="feather-sm fill-white me-2"
                                ></i>
                                Ajouter
                            </button>
                        </div>
                    </div>
                </h4>
            </div>
            <div class="card-body">

                <img  src="{{ asset('public/images/signatures/'.$user->company->signature) }}" alt="signature" class="img-fluid">
                {{-- Modal Ajouter--}}
                <div
                    class="modal fade"
                    id="add-signature"
                    tabindex="-1"
                    aria-labelledby="add-signature"
                    aria-hidden="true"
                >
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header d-flex align-items-center modal-colored-header bg-info text-white">
                                <h4 class="modal-title" id="detailTitle">
                                    Ajouter une signature
                                </h4>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="modal-body">
                                <h4 class="card-title mb-3"></h4>
                                <form action = "{{ route('storeSignature') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input
                                                type="file"
                                                name="signature"
                                                id="signature"
                                                class="form-control"
                                                placeholder="Signature"
                                                 @error('signature') class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8" @enderror
                                            />
                                            <input
                                                type="hidden"
                                                name="id_user"
                                                id="id_user"
                                                class="form-control"
                                                value="{{$user->id}}"
                                            />
                                            @error('signature')
                                            <span class="text-danger-main fw-semibold">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                            <label
                                            ><i
                                                    class="feather-sm text-dark fill-white me-2"
                                                ></i
                                                >Signature<span class="text-danger">*</span></label>
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
                                                    Ajouter
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                {{-- end Modal--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('resources/js/bvf/offer/offerReceived.js') }}"></script>
<script>
    $(document).ready(function () {
        //Detail Offer
        $('#btn-add-signature').click(function (){
            $('#add-signature').modal('show');
        });

        //Update Offer
        $('#btn-update-signature').click(function () {

            $('#update-signature').modal('show');
        });
    });
</script>
@endsection
