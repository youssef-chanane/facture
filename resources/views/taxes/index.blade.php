@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">
                <div class="col-12"><div class="d-flex justify-content-end mb-2">
                    <a href="{{route('taxes.create')}}" class="btn btn-success ml-200">ajouter taxe</a>
                </div>
                Liste des taxes</h4>
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>type de taxe</th>
                    <th>patanta</th>
                    <th>paiement</th>
                    <th>Nom du client</th>
                    <th>Dernier facture payé</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($taxes as $taxe)
                        <tr>
                            <td>{{$taxe->id}}</td>
                            <td>{{$taxe->type}}</td>
                            <td>{{$taxe->tp}}</td>
                            <td>{{$taxe->paiement}}</td>
                            <td>{{$taxe->client()->pluck('nom')[0]}} {{$taxe->client()->pluck('prenom')[0]}}</td>
                            <td> {{($taxe->paiement=="trimestriel")?"trimestre $taxe->last_tranche":''}} {{($taxe->paiement=="mensuel")?"mois $taxe->last_tranche":''}} {{$taxe->last_year}}</td>
                            <td><a class="btn btn-success" href="{{route('taxes.edit',$taxe->id)}}">modifier</a></td>
                            <td>
                                <form action="{{route('taxes.destroy',$taxe->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="suprimmer" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
        
                    @endforeach
                </tbody>
            </table>        
        </div>
    </div>
    
@endsection