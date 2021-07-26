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
@section('scriptContent')
<script>

$(function(){
    //afficher le nom et le prenom aprés l'entré du cin
    let clients =@json($clients);
    console.log(clients);
    client=clients.filter(el=>el.cin==$("#cin").val())[0];
    //console.log(client.nom);
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
        // console.log(client);
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
    
    //changer les valeurs du tranche selon le type de paiement
    if($("#paiement").val()=="trimestriel"){
        $("#tranche").html('<option value="1">trimestre 1</option><option value="2">trimestre 2</option><option value="3">trimestre 3</option><option value="4">trimestre 4</option>');
    }
    if($("#paiement").val()=="mensuel"){
        $("#tranche").html('<option value="1">Janvier</option><option value="2">Février</option><option value="3">Mars</option><option value="4">Avril</option><option value="5">Mai</option><option value="6">Juin</option><option value="7">Juillet</option><option value="8">août</option><option value="9">Septembre</option><option value="10">Octobre</option><option value="11">Novembre</option><option value="12">Décembre</option>');
    }
    if($("#paiement").val()=="annuel"){
        $(".hide").hide();
    }else{
        $(".hide").show();
    }
    $("#paiement").change(function(){
        if($(this).val()=="trimestriel"){
            $("#tranche").html('<option value="1">trimestre 1</option><option value="2">trimestre 2</option><option value="3">trimestre 3</option><option value="4">trimestre 4</option>');
        }
        if($(this).val()=="mensuel"){
            $("#tranche").html('<option value="1">Janvier</option><option value="2">Février</option><option value="3">Mars</option><option value="4">Avril</option><option value="5">Mai</option><option value="6">Juin</option><option value="7">Juillet</option><option value="8">août</option><option value="9">Septembre</option><option value="10">Octobre</option><option value="11">Novembre</option><option value="12">Décembre</option>');
        }
        if($(this).val()=="annuel"){
            $(".hide").hide();
        }else{
            $(".hide").show();
        }    
    });        
});
</script>

@endsection