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
@section('scriptContent')
<script>

$(function(){
    //afficher le nom et le prenom aprés l'entré du cin
    let clients =@json($clients);
    console.log(clients);
    client=clients.filter(el=>el.cin==$("#cin").val())[0];
        if(typeof(client) != 'undefined' && client.nom){
            $("#fadeNom").fadeIn("fast");
            $("#nom").val(client.nom);
            $("#prenom").val(client.prenom);
            $("#cin").addClass("is-valid");
            $("#cin").removeClass("is-invalid");
        }else{
            $("#fadeNom").fadeOut();
            $("#cin").addClass("is-invalid");
            $("#cin").removeClass("is-valid");

        }
    $("#cin").change(function(){
        let clients =@json($clients);
        client=clients.filter(el=>el.cin==$(this).val())[0];
        console.log(client);
        if(typeof(client) != 'undefined' && client.nom){
            $("#fadeNom").fadeIn("fast");
            $(this).addClass("is-valid");
            $(this).removeClass("is-invalid");
            $("#nom").val(client.nom);
            $("#prenom").val(client.prenom);
        }else{
            $("#fadeNom").fadeOut();
            $(this).addClass("is-invalid");
            $(this).removeClass("is-valid");
        }
   

    }
    );
           
});
</script>

@endsection