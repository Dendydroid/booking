@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">Manage Bookings</div>

                    <div class="card-body tabs-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                       <?php
                            $bookings = \App\Booking::all();

                            $activeBookings = \App\Booking::where("active", 1)->get();

                            $rooms = \App\Room::all();
                            $clients = \App\Client::all();

                            $blacklistedClients = \App\Client::where("is_black_listed", 1)->get();

                            ?>

                            <table class="table w-100 m-0 p-0">
                                <tr>
                                    <td>Indicator</td>
                                    <td>Value</td>
                                </tr>
                                <tr>
                                    <td>Room count:</td>
                                    <td>{{count($rooms->toArray())}}</td>
                                </tr>
                                <tr>
                                    <td>Clients count:</td>
                                    <td>{{count($clients->toArray())}}</td>
                                </tr>
                                <tr>
                                    <td>Booking count <small class="text-muted">(All time)</small>:</td>
                                    <td>{{count($bookings->toArray())}}</td>
                                </tr>
                                <tr>
                                    <td>Booking count <small class="text-muted">(At the moment)</small>:</td>
                                    <td>{{count($activeBookings->toArray())}}</td>
                                </tr>
                                <tr>
                                    <td>Blacklisted clients count:</td>
                                    <td>{{count($blacklistedClients->toArray())}}</td>
                                </tr>

                            </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
