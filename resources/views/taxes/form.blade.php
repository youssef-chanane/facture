<div class="row g-3 align-items-center mb-3">
    <div class="col-auto">
        <label for="cin">Cin :</label>
    </div>
    <div class="col-auto">
        <input type="text" name="cin" id="cin" placeholder="cin" class="form-control" value="{{old('cin',isset($client->cin) ? $client->cin:'') ?? NULL}}">
    </div>
</div>
<div class="row g-3 align-items-center" style="display: none;" id="fadeNom">
    <div class="col-auto">
      <label for="nom" class="col-form-label">Nom:</label>
    </div>
    <div class="col-auto">
      <input type="text" id="nom" class="form-control" disabled>
    </div>
    <div class="col-auto">
        <label for="prenom" class="col-form-label">prenom:</label>
      </div>
      <div class="col-auto">
        <input type="text" id="prenom" class="form-control" disabled>
    </div>


</div>
@if(!isset($taxe))
<div class="form-group">
    <label for="tp">TP :</label>
    <input type="text" name="tp" id="tp" placeholder="exp:12345678" class="form-control"  value="{{old('tp',isset($taxe->tp) ? $taxe->tp:'') ?? NULL}}">
</div>
<div class="form-group">
    <label for="type">Type de taxe à payer :</label>
    <input type="text" name="type" id="type" placeholder="exp: taxe sur débit de boisson" class="form-control"  value="{{old('type',isset($taxe->type) ? $taxe->type:'') ?? NULL}}">
</div>
<div class="form-group">
    <label for="paiement">Régime</label>
    <select name="paiement" id="paiement" class="form-control basic-multiple">
        <option value="annuel"  {{(isset($taxe) && $taxe->paiement=='annuel')? 'selected' : ' '}}>annuel</option>
        <option value="trimestriel"  {{(isset($taxe) && $taxe->paiement=='trimestriel')? 'selected' : ' '}}>trimestriel</option>
        <option value="mensuel"  {{(isset($taxe) && $taxe->paiement=='mensuel')? 'selected' : ' '}}>mensuel</option>
    </select>
</div>
<div class="row g-3 align-items-center">
    <div class="col-auto">
        <label for="annee">année du dernier facture payée </label>
    </div>
    <div class="col-auto">
        <select name="last_year" id="annee" class="form-control">
            @for($i=date('Y')-10;$i<=date('Y');$i++)
                <option value="{{$i}}" {{($i==date('Y')) ? "selected":" "}}>{{$i}}</option>
            @endfor
        </select>
    </div>
    <div class="col-auto hide">
        <label for="tranche">Tranche</label>
    </div>
    <div class="col-auto hide" >
        <select name="last_tranche" id="tranche" class="form-control basic-multiple">
    
        </select>
    </div>
</div>
@endif

@if($errors->any())
 <div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li class="list-group-item text-danger">{{$error}}</li>
        @endforeach
    </ul>
 </div>
 @endif
<div class="form-group mt-4">
    <button class="btn btn-success" type="submit">Enregistrer</button>
</div>
<script>
    // $(function(){
    //     //afficher le nom et le prenom aprés l'entré du cin
    //     let clients =@json($clients);
    //     console.log(clients);
    //     client=clients.filter(el=>el.cin==$("#cin").val())[0];
    //     console.log(client.nom);
    //         if(client && client.nom){
    //             $("#fadeNom").fadeIn("fast");
    //             $("#nom").val(client.nom);
    //             $("#prenom").val(client.prenom);
    //             $("#cin").addClass("is-valid");
    //             $("#cin").removeClass("is-invalid");
    //         }else{
    //             $("#fadeNom").fadeOut();
    //             $("#cin").addClass("is-invalid");
    //             $("#cin").removeClass("is-valid");

    //         }
    //     $("#cin").change(function(){

    //         client=clients.filter(el=>el.cin==$(this).val())[0];
    //         if(client && client.nom){
    //             $("#fadeNom").fadeIn("fast");
    //             $(this).addClass("is-valid");
    //             $(this).removeClass("is-invalid");
    //             $("#nom").val(client.nom);
    //             $("#prenom").val(client.prenom);
    //         }else{
    //             $("#fadeNom").fadeOut();
    //             $(this).addClass("is-invalid");
    //             $(this).removeClass("is-valid");
    //         }
       

    //     }
    //     );
        
    //     //changer les valeurs du tranche selon le type de paiement
    //     if($("#paiement").val()=="trimestriel"){
    //         $("#tranche").html('<option value="1">trimestre 1</option><option value="2">trimestre 2</option><option value="3">trimestre 3</option><option value="4">trimestre 4</option>');
    //     }
    //     if($("#paiement").val()=="mensuel"){
    //         $("#tranche").html('<option value="1">Janvier</option><option value="2">Février</option><option value="3">Mars</option><option value="4">Avril</option><option value="5">Mai</option><option value="6">Juin</option><option value="7">Juillet</option><option value="8">août</option><option value="9">Septembre</option><option value="10">Octobre</option><option value="11">Novembre</option><option value="12">Décembre</option>');
    //     }
    //     if($("#paiement").val()=="annuel"){
    //         $(".hide").hide();
    //     }else{
    //         $(".hide").show();
    //     }
    //     $("#paiement").change(function(){
    //         if($(this).val()=="trimestriel"){
    //             $("#tranche").html('<option value="1">trimestre 1</option><option value="2">trimestre 2</option><option value="3">trimestre 3</option><option value="4">trimestre 4</option>');
    //         }
    //         if($(this).val()=="mensuel"){
    //             $("#tranche").html('<option value="1">Janvier</option><option value="2">Février</option><option value="3">Mars</option><option value="4">Avril</option><option value="5">Mai</option><option value="6">Juin</option><option value="7">Juillet</option><option value="8">août</option><option value="9">Septembre</option><option value="10">Octobre</option><option value="11">Novembre</option><option value="12">Décembre</option>');
    //         }
    //         if($(this).val()=="annuel"){
    //             $(".hide").hide();
    //         }else{
    //             $(".hide").show();
    //         }    
    //     });        
    // });
</script>