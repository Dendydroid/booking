@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-header">Management</div>

                    <div class="card-body tabs-body p-0">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        @if(!empty($clients->toArray()))
                            <table class="table w-100 m-0 p-0">
                                <tr>
                                    <td>Name</td>
                                    <td>Phone</td>
                                    <td>Blacklist / De-Blacklist</td>
                                    <td>First visit</td>
                                </tr>
                            @foreach($clients as $client)
                                    <tr>
                                        <td>{{$client->name}}</td>
                                        <td>{{$client->phone}}</td>
                                        <td>
                                            @if($client->is_black_listed==1)
                                                <a href="/de-blacklist/{{$client->id}}" class="btn btn-sm btn-success">De-Blacklist</a>
                                            @else
                                                <a href="/blacklist/{{$client->id}}" class="btn btn-sm btn-danger">Blacklist</a>
                                            @endif
                                        </td>
                                        <td>{{$client->created_at}}</td>
                                    </tr>
                            @endforeach
                            </table>
                        @else
                            <p class="center-info">
                                Client list is empty!
                            </p>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
