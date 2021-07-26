<div class="row g-3 align-items-center mb-3">
    <div class="col-2">
        <label for="nom" class="col-form-label">Nom:</label>
      </div>
      <div class="col-4">
        <input type="text" id="nom" class="form-control" value="{{$client->nom}}" disabled>
      </div>
      <div class="col-2">
          <label for="prenom" class="col-form-label">prenom:</label>
        </div>
        <div class="col-4">
          <input type="text" id="prenom" class="form-control" value="{{$client->prenom}}" disabled>
      </div>
</div>

<div class="row  g-3 align-items-center mb-3">
    <div class="col-2">
        <label for="cin">cin</label>
    </div>
    <div class="col-4">
        <input type="text" class="form-control" id="cin" name="cin" value="{{$client->cin}}" disabled>
    </div>
    <div class="col-2">
        <label for="tp">Taxe Professionnelle</label>
    </div>
    <div class="col-4">
        <input type="text" name="tp" id="tp" value="{{$taxe->tp}}" class="form-control" disabled>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <label for="paiemenet">Régime :</label>
        <input type="text" id="paiement" name="paiement" value="{{$taxe->paiement}}" readonly class="form-control">
    </div>
    <div class="col-4">
        <label for="annee">Annee :</label>
        <input type="text" readonly name="annee" id="annee" class="form-control">       
    </div>
    <div class="col-4">
        <label for="">Tranche :</label>
        <input type="text" readonly name="tranche" id="tranche" class="form-control">
    </div>
</div>
<div class="form-group">
    <label for="n_quetence">numéro de quetence :</label>
    <input type="text" name="n_quetence" id="n_quetence" class="form-control" >
</div>
<div class="form-group">
    <label for="montant">Montant :</label>
    <input type="text" name="montant" id="montant" class="form-control" >
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
{{-- <script>
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
</script> --}}