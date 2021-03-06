@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" >
                <div class="card-header">Змінити данні номеру / Дії</div>

                <div class="card-body ">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                        @php
                            $booking = \App\Booking::where([
                                ['room_number',"=",$room->number],
                                ['active',"=",1],
                            ])->first();
                        @endphp

                        

                    <form method="POST" action="{{ route('edit-room') }}">
                        @csrf

                        <input id="id" name="id" value="{{ $room->id }}" type="hidden" required>

                        <div class="form-group row">
                            <label for="number" class="col-md-4 col-form-label text-md-right">Код номеру</label>

                            <div class="col-md-6">
                                <input id="number" placeholder="100A" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ $room->number }}" required autofocus>

                                @error('number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Ціна за ніч</label>

                            <div class="col-md-6">
                                <input id="price" min="0" placeholder="$" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $room->price }}" required>

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stars" class="col-md-4 col-form-label text-md-right">Рівень комфорту</label>

                            <div class="col-md-6">
                                <input id="stars" min="1" max="5" placeholder="1 - 5" type="number" step="0.1" class="form-control @error('stars') is-invalid @enderror" name="stars" value="{{ $room->stars }}" required>

                                @error('stars')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="is_conf" class="col-md-4 col-form-label text-md-right">Номер є конференц-залою</label>

                            <div class="col-md-6" style="display: flex;align-items: center;">
                                <input style="cursor: pointer" id="is_conf" type="checkbox" class="form-control-checkbox" name="is_conf" {{($room->type == 1 ? "checked" : "")}}>
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Зберегти
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class='m-0 pl-2 text-muted' style="font-size:1.2rem">Iсторія:</p>
                         <table class="table w-100 m-0 p-0 table-striped table-hover">
                                <tr>
                                    <td>Клієнт</td>
                                    <td>З</td>
                                    <td>По</td>
                                    <td>Виселити</td>
                                </tr>
                                @php
                                    $bookings = \App\Booking::where('room_number', $room->number)->get(); 
                                    $bookings = array_reverse($bookings->toArray());
                                @endphp
                                @foreach($bookings as $booking)
                                @php
                                    $client = \App\Client::where('id', $booking['client_id'])->first();
                                @endphp
                                    <tr>
                                        <td>{{$client->name}} <small class="text-muted">({{$client->phone}})</small></td>
                                        <td>{{$booking['night_start']}}</td>
                                        <td>{{$booking['night_end']}}</td>
                                        <td>
                                            <form method="POST" action="/evict/{{$booking['id']}}">
                                                @csrf
                                                @if($booking['active'] == 1)
                                                    <input type="submit" class="btn btn-danger" value="Виселити">
                                                    @else
                                                    <input type="submit" class="btn btn-light" value="Виселити" disabled>
                                                @endif

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
