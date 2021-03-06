@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">Додати номер</div>

                    <div class="card-body ">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form method="POST" action="{{ route('add-room') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="number" class="col-md-4 col-form-label text-md-right">Код номеру</label>

                                    <div class="col-md-6">
                                        <input id="number" placeholder="100A" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}" required autofocus>

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
                                        <input id="price" min="0" placeholder="&#8372;" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required>

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
                                        <input id="stars" min="1" max="5" placeholder="0 - 5" type="number" step="0.1" class="form-control @error('stars') is-invalid @enderror" name="stars" value="{{ old('stars') }}" required>

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
                                        <input style="cursor: pointer" id="is_conf" type="checkbox" class="form-control-checkbox" name="is_conf">
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
