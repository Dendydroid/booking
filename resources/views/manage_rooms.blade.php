@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">Rooms Management</div>

                    <div class="card-body tabs-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(!empty($rooms->toArray()))

                            @foreach($rooms as $room)

                               <a class="room" href="/edit-room/{{$room->id}}">
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
                                       $booking = \App\Booking::where([
                                           ['client_id',"=",$room->client_occupied_id],
                                           ['active',"=",1],
                                        ])->first();
                                   @endphp
                                   @if($client instanceof \App\Client && $booking instanceof \App\Booking)
                                       <div class="occupied small" style="color:darkred;text-align: center">
                                           Occupied by {{$client->name}} <small class="text-muted">({{$client->phone}})</small>  <br>since <b>{{$booking->created_at}}</b><br>for <b>{{$booking->nights}}</b> nights
                                       </div>
                                       @else
                                   @endif
                               </a>

                            @endforeach
                        @else
                            <p class="center-info">
                                Room list is empty!
                            </p>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
