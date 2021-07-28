@extends('layouts.app')
@section('content')
<div class="card card-default w-75 m-auto">
    <div class="card-header">Ajouter un compteur</div>
    <div class="card-body">
        <form action="{{route('counters.store')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="type">Type</label>
              <input type="text" name="type" id="type" class="form-control" placeholder="" >
            </div>
            <div class="form-group">
                <label for="counter">le numéro de la dérniere facture</label>
                <input type="text" name="counter" id="counter" class="form-control" placeholder="" >
            </div>
            @if($errors->any())
             <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li class="list-group-item text-danger">{{$error}}</li>
                    @endforeach
                </ul>
             </div>
             @endif
            <div class="form-group">
                <button class="btn btn-success" type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection