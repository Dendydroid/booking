@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">Керування номерами</div>

                    <div class="card-body tabs-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(!empty($rooms->toArray()))

                            @foreach($rooms as $room)

                               <a class="room" href="/edit-room/{{$room->id}}" style="min-width: 12rem">
                                   <div class="type">
                                       <div class="text-muted p-2">
                                           {{($room->type == 1 ? "Конференц-зала" : "Номер")}}
                                       </div>
                                   </div>
                                   <div class="number" style="display: flex;align-items: center">
                                       {{$room->number}}
                                   </div>
                                   <div>
                                       &nbsp;Рівень комфорту: <small class="text-muted"><span style="color:goldenrod;font-weight: bold">{{$room->stars}}</span></small>
                                   </div>
                                   <div class="price">
                                       {{$room->price}} <small style="color:darkgreen">&#8372;</small><small class="text-muted">&nbsp;/&nbsp;за ніч</small>
                                   </div>
                               </a>

                            @endforeach
                        @else
                            <p class="center-info">
                                Список номерів порожній!
                            </p>
                        @endif
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
