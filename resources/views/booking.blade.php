@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">Rooms</div>

                    <div class="card-body tabs-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a class="manage-tab" href="{{route('add-booking')}}">
                            <div class="tab-title">
                                Add Booking
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
