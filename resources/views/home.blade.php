@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" >
                <div class="card-header">Керування</div>

                <div class="card-body tabs-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <a class="manage-tab" href="{{route("rooms")}}">
                            <div class="tab-title">
                                Номери
                            </div>
                        </a>

                        <a class="manage-tab" href="{{route("booking")}}">
                            <div class="tab-title">
                                Бронювання
                            </div>
                        </a>

                        <a class="manage-tab" href="{{route("clients")}}">
                            <div class="tab-title">
                                Клієнти
                            </div>
                        </a>

                        <a class="manage-tab" href="{{route("statistics")}}">
                            <div class="tab-title">
                                Статистика
                            </div>
                        </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
