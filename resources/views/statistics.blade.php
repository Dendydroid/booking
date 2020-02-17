@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">Статистика</div>

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
                                    <td>Показник</td>
                                    <td>Значення</td>
                                </tr>
                                <tr>
                                    <td>Кількість кімнат:</td>
                                    <td>{{count($rooms->toArray())}}</td>
                                </tr>
                                <tr>
                                    <td>Кількість клієнтів:</td>
                                    <td>{{count($clients->toArray())}}</td>
                                </tr>
                                <tr>
                                    <td>Кількість бронювань <small class="text-muted">(За весь час)</small>:</td>
                                    <td>{{count($bookings->toArray())}}</td>
                                </tr>
                                <tr>
                                    <td>Кількість бронювань <small class="text-muted">(на даний момент)</small>:</td>
                                    <td>{{count($activeBookings->toArray())}}</td>
                                </tr>
                                <tr>
                                    <td>Кількість клієнтів яким заборонено вхід:</td>
                                    <td>{{count($blacklistedClients->toArray())}}</td>
                                </tr>

                            </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
