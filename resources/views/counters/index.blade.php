@extends('layouts.app')
@section('content')
    <div class="card col-8 m-auto">
        <div class="card-body">

            <h4 class="card-title">
                <div class="col-12"><div class="d-flex justify-content-end mb-2">
                    <a href="{{route('counters.create')}}" class="btn btn-success ml-200">ajouter compteur</a>
                </div>
                Liste des compteurs
            </h4>
       <ul class="list-group">
           @foreach ($counters as $counter)
               <li class="list-group-item">
                   <h2 class="row">
                       <div class="col-7">

                           {{$counter->type}}
                       </div>
                       <span class="col-1 badge bg-primary rounded-pill text-light pt-3 mx-5">{{$counter->counter}}</span>
                       <form action="{{route('counters.update',$counter->id)}}" method="post" class="col-2">
                        @csrf
                        @method('PUT')
                        <input type="submit" style="font-size: 2rem; height:3rem;width:3rem" value="+" class="btn btn-danger rounded-circle pb-5 pt-0">
                    </form>
                   </h2>
                </li>
           @endforeach
       </ul>
        </div>
    </div>
@endsection