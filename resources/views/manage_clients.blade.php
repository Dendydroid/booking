@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">Керування клієнтами</div>

                    <div class="card-body tabs-body p-0">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        @if(!empty($clients->toArray()))
                            <table class="table w-100 m-0 p-0">
                                <tr>
                                    <td>Ім'я</td>
                                    <td>Номер телефону</td>
                                    <td>Заборонити / Зняти заборону</td>
                                    <td>Перший візит</td>
                                </tr>
                            @foreach($clients as $client)
                                    <tr>
                                        <td>{{$client->name}}</td>
                                        <td>{{$client->phone}}</td>
                                        <td>
                                            @if($client->is_black_listed==1)
                                                <a href="/de-blacklist/{{$client->id}}" class="btn btn-sm btn-success">Зняти заборону</a>
                                            @else
                                                <a href="/blacklist/{{$client->id}}" class="btn btn-sm btn-danger">Заборонити</a>
                                            @endif
                                        </td>
                                        <td>{{$client->created_at}}</td>
                                    </tr>
                            @endforeach
                            </table>
                        @else
                            <p class="center-info">
                                Список клієнтів порожній!
                            </p>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
