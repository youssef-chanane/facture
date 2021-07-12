<div class="form-group">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" class="form-control" value="{{old('nom',isset($client->nom) ? $client->nom:'') ?? NULL}}">
</div>
<div class="form-group">
    <label for="prenom">Prenom :</label>
    <input type="text" name="prenom" id="prenom" class="form-control" value="{{old('prenom',isset($client->prenom) ? $client->prenom:'') ?? NULL}}">
</div>
<div class="form-group">
    <label for="cin">CIN :</label>
    <input type="text" name="cin" id="cin" class="form-control" value="{{old('cin',isset($client->cin) ? $client->cin:'') ?? NULL}}">
</div>
<div class="form-group">
    <label for="n_tel">Numéro du téléphone :</label>
    <input type="text" name="n_tel" id="n_tel" class="form-control" value="{{old('n_tel',isset($client->n_tel) ? $client->n_tel:'') ?? NULL}}">
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