@extends('layouts.admin.app')

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
            <h3 class="text-themecolor mb-0">Notification</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Notification</a>
                </li>
                <li class="breadcrumb-item active">Notification reçues</li>
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

                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            id="lang_file"
                            class="table table-striped table-bordered display"
                            style="width: 100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Description</th>
                                <th>Auteur</th>
                                <th>Date </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i =1;
                            @endphp
                            @foreach($notifs->sortBy('created_at') as $notif)
                                <tr  >
                                    <td>{{ $i }}</td>
                                    <td>{{ $notif->action }}</td>
                                    <td>{{ $notif-> description}}</td>
                                    <td>{{ $notif-> created_by}}</td>
                                    <td>{{ date("d/m/Y", strtotime($notif-> created_at))}}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Action</th>
                                <th>Description</th>
                                <th>Auteur</th>
                                <th>Date </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('src/dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>
    <script src="{{ asset('src/dist/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
@endsection
