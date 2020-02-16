@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">Add Booking</div>

                    <div class="card-body ">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('add-booking') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="number" class="col-md-4 col-form-label text-md-right">Room Number</label>

                                <div class="col-md-6">

                                    <select name="number" id="number" class="form-control @error('number') is-invalid @enderror" required autofocus style="cursor: pointer">
                                        @foreach($rooms as $room)
                                            @if($room->status === "free")
                                                <option value="{{$room->number}}">{{$room->number}}</option>
                                            @endif
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
                                <label for="nights" class="col-md-4 col-form-label text-md-right">Nights</label>

                                <div class="col-md-6">
                                    <input id="nights" min="1" placeholder="1" type="nights" step="1" class="form-control @error('nights') is-invalid @enderror" name="nights" value="{{ old('nights') }}" required>

                                    @error('nights')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="client" class="col-md-4 col-form-label text-md-right">Client</label>

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
                                        Submit
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
