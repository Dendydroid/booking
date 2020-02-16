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

                            @if(!empty($bookings->toArray()))

                                @foreach($bookings as $booking)

                                    <a class="room" href="/edit-booking/{{$booking->id}}">
                                        <div class="type">
                                            <div class="text-muted p-2">
                                                {{($room->type == 1 ? "Conference Hall" : "Room")}}
                                            </div>
                                        </div>
                                        <div class="number" style="display: flex;align-items: center">
                                            {{$room->number}}&nbsp;<small class="text-muted">{{$room->stars}}<span style="color:gold">&#9733;</span></small>
                                        </div>
                                        <div class="price">
                                            {{$room->price}} <small style="color:darkgreen">$</small><small class="text-muted">&nbsp;/&nbsp;per night</small>
                                        </div>
                                        @php
                                            $client = \App\Client::where('id',$room->client_occupied_id)->first();
                                        @endphp
                                        @if($client instanceof \App\Client)
                                            <div class="occupied small" style="color:darkred">
                                                Occupied by {{$client->name}}
                                            </div>
                                        @else
                                        @endif
                                    </a>

                                @endforeach
                            @else
                                <p class="center-info">
                                    Booking list is empty!
                                </p>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
