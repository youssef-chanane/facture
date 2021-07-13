@extends('layouts.app')
@section('content')
<div class="card card-default w-75 m-auto">
    <div class="card-header">Ajouter un taxeclient</div>
    <div class="card-body">
    <form action="{{route('taxes.update',$taxe->id)}}" method="post">
        @csrf
        @method('PUT')
        @include('taxes.form')

    </form>
    </div>
</div>
@endsection