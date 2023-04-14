@extends('layouts.app')

@section('content')


<div class="container" style="font-size: 13px">


    <div class="row justify-content-center">

        <div class="col-12">
            <div class="card mt-1">
                <div class="card-header grey">
                    <h1>Clients List</h1>
                </div>

                <div class="card-body grey">
                    <ul class="list-group">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><b>ID</b></th>
                                    <th scope="col"><b>Name</b></th>
                                    <th scope="col"><b>Surname</b></th>
                                    <th scope="col"><b>Personal code</b></th>
                                    <th scope="col"><b>Account number</b></th>
                                    <th scope="col"><b>Account balance, Eur</b></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clients as $client)
                                <tr>
                                    <td> {{$client->id}} </td>
                                    <td> {{$client->name}} </td>
                                    <td> {{$client->surname}}</td>
                                    <td> {{$client->personal_code}}</td>
                                    <td> {{$client->acc_number}}</td>
                                    <td> <b><i> {{number_format($client->acc_balance, 2, ',', ' ')}} </i> </b></td>
                                    {{-- <td> <a href="{{route('clients-show', $client)}}" class="btn btn-info">Show</a></td> --}}
                                    {{-- <td> <a href="{{route('clients-edit', $client)}}" class="btn btn-success">Edit</a></td> --}}
                                    <td><a href="{{route('clients-addfunds', $client)}}" class="btn btn-outline-dark brown" style="font-size: 12px">Add Funds</a></td>
                                    <td><a href="{{route('clients-withdrawfunds', $client)}}" class="btn btn-outline-dark brown" style="font-size: 12px">Withdraw Funds</a></td>
                                    <td>
                                        <form action="{{route('clients-delete', $client)}}" method="post">
                                            <button type="submit" class="btn btn-danger btn-outline-dark" style="font-size: 12px">Delete</button>
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                                </li>
                                @empty
                                <li class="list-group-item">
                                    <div class="client-line">No clients</div>
                                </li>
                                @endforelse

                            </tbody>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
