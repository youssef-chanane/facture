@extends('layouts.app')
@section('content')
<div class="card card-default w-75 m-auto">
    <div class="card-header">Ajouter un client</div>
    <div class="card-body">
    <form action="{{route('clients.update',$client->id)}}" method="post">
        @csrf
        @method('PUT')
        @include('clients.form')

    </form>
    </div>
</div>
@endsection