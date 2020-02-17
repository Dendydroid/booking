@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">Додати бронювання</div>

                    <div class="card-body ">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('add-booking') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="number" class="col-md-4 col-form-label text-md-right">Номер</label>

                                <div class="col-md-6">

                                    <select name="number" id="number" class="form-control @error('number') is-invalid @enderror" required autofocus style="cursor: pointer">
                                        @foreach($rooms as $room)
                                 
                                                <option value="{{$room->number}}">{{$room->number}}</option>
                                         
                                        @endforeach
                                    </select>

                                    @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fromto" class="col-md-4 col-form-label text-md-right">З, По <small class="text-muted">(включно)</small></label>

                                <div class="col-md-6">
                                    <input type="text" placeholder="Дати" class="datepicker-from-to form-control @error('fromto') is-invalid @enderror" name='fromto' value="{{ old('fromto') }}" required>

                                    @error('fromto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="client" class="col-md-4 col-form-label text-md-right">Клієнт</label>

                                <div class="col-md-6">
                                    <select name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror" required style="cursor: pointer">
                                        @foreach($clients as $client)
                                            @if($client->is_black_listed != "1")
                                                <option value="{{$client->id}}">{{$client->name}} ({{$client->phone}})</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('client_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@php
    $forbiddenDates = [];
    $bookings = App\Booking::all();
    $nowDate = new \DateTime();
    foreach($bookings->toArray() as $booking){
        $startDate = new \DateTime($booking['night_start']);   
        $endDate = new \DateTime($booking['night_end']); 
        
        if($nowDate>=$startDate && $nowDate<=endDate){

        }
    }
@endphp
@push('custom-scripts')
@if(isset(request()->session()->all()['taken']))
<script>
alert('Дати у вказаному дiапазонi зайнятi для вказаного номера!');
</script>
@php
session()->forget('taken');
@endphp
@endif
<script type="text/javascript">



        $('.datepicker-from-to').datepicker({
            minDate:new Date(),
            range:true  
        })
    </script>
@endpush

