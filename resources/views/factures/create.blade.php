@extends('layouts.app')
@section('content')
@can('view',$taxe)
    <div class="card card-default w-75 m-auto">
        <div class="card-header">Ajouter un client</div>
        <div class="card-body">
            <form action="{{route('factures.store',$taxe->id)}}" method="post">
                @csrf
                @include('factures.form')
            </form>
        </div>
    </div>
@endcan
@endsection
@section('scriptContent')
<script>
    $(function(){
        let paiement=$("#paiement").val();
        const d=new Date();
        const taxe=@json($taxe);
        const last_year=taxe.last_year;
        const last_tranche=taxe.last_tranche;
        // console.log(last_tranche);
        // console.log(d.getFullYear());
        
        if(paiement=="annuel"){
            if(last_year<d.getFullYear()){
                $("#annee").val(last_year+1);
            }else{
                $("form").after('<div class="alert alert-success">il n ya rien à payé <a href="{{route("taxes.index")}}"">retourner à la liste des taxes</a></div>');
                $('form').remove();
            }
        }if(paiement=="mensuel"){
            if(last_tranche<12){
                $("#tranche").val(last_tranche+1);
                $("#annee").val(last_year);
            }else{
                if(last_year<d.getFullYear()){
                    $("#tranche").val(1);
                    $("#annee").val(last_year+1);
                }else{
                    $("form").after('<div class="alert alert-success">il n ya rien à payé <a href="{{route("taxes.index")}}"">retourner à la liste des taxes</a></div>');
                    $('form').remove();
                }
            }
        }if(paiement=="trimestriel"){
            if(last_tranche<4){
                $("#tranche").val(last_tranche+1);
                $("#annee").val(last_year);
            }else{
                if(last_year<d.getFullYear()){
                    $("#tranche").val(1);
                    $("#annee").val(last_year+1);
                }else{
                    $("form").after('<div class="alert alert-success">il n ya rien à payé <a href="{{route("taxes.index")}}"">retourner à la liste des taxes</a></div>');
                    $('form').remove();
                }
            }
        }
    }
    );
</script>
@endsection