@extends('layouts.app')
@section('content')
<div class="card card-default w-75 m-auto">
    <div class="card-header">Ajouter une taxe</div>
    <div class="card-body">
        <form action="{{route('taxes.store')}}" method="post">
            @csrf
            @include('taxes.form')
        </form>
    </div>
</div>
    
@endsection