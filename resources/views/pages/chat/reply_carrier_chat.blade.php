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


@section('styles')

@endsection

@section('content')
<div class="box-heading">
    <div class="box-title">
        <h3 class="mb-35">Messagerie</h3>
    </div>
   
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-head">
            <div class="card-title">
                <h5> Itinéraire: {{ $transportAnnouncement->origin.'--'.$transportAnnouncement->destination }}</h5>
                <span class="job-type">Date d'expiration: {{ date("d/m/Y", strtotime($transportAnnouncement->limit_date)) }}</span>
            </div>
        </div>
    </div>
</div>

@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif

<div class="card chat">
    <div class="row g-0">
        <div class="col-12 col-lg-12 col-xl-12 col-md-12">
            <div class="py-2 px-4 border-bottom d-flex d-lg-block d-md-block d-sm-block">
                <!-- titre conversation -->
            </div>
            <div class="position-relative">
                <div class="chat-messages p-4">
                    @foreach($chatMessages as $message)
                    <div class="chat-message-{{ $message->fk_user_id === session('user_id') ? 'right' : 'left' }} pb-4">
                        <div>
                            <div>
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                <div class="text-muted small text-nowrap mt-2">{{ $message->created_at }}</div>
                            </div>
                            <div class="font-weight-bold mb-1">
                                @if($message->fk_user_id === session('userId'))
                                    Vous
                                @else
                                    {{ $message->username }}
                                @endif
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3">
                                {{ $message->message }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="flex-grow-0 py-3 px-4 border-top">
                    <form action="{{ route('sendMessage', ['offer_id' => $freightOffer->id]) }}" method="post">
                        @csrf
                        <input type="text" class="form-control" placeholder="Entrez votre message" name="message">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
