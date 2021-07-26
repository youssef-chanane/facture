@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">
                <div class="col-12"><div class="d-flex justify-content-end mb-2">
                    <a href="{{route('clients.create')}}" class="btn btn-success ml-200">ajouter client</a>
                </div>
                Liste des clients</h4>
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Nom</th>
                    <th>CIN </th>
                    <th>Tél</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        @can('view',$client)
                            <tr>
                                <td>{{$client->id}}</td>
                                <td>{{$client->nom}} {{$client->prenom}}</td>
                                <td>{{$client->cin}}</td>
                                <td>{{$client->n_tel}}</td>
                                <td><a class="btn btn-success" href="{{route('clients.edit',$client->id)}}">modifier</a></td>
                                <td>
                                    <form action="{{route('clients.destroy',$client->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="suprimmer" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @endcan
                    @endforeach
                </tbody>
            </table>        
        </div>
    </div>
    
@endsection