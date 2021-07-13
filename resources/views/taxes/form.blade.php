<div class="form-group">
    <label for="cin">Carte d'identité nationale :</label>
    <input type="text" name="cin" id="cin" placeholder="cin" class="form-control" value="{{old('cin',isset($client->cin) ? $client->cin:'') ?? NULL}}">
</div>
<div class="form-group">
    <label for="tp">patanta :</label>
    <input type="text" name="tp" id="tp" placeholder="exp:12345678" class="form-control"  value="{{old('tp',isset($taxe->tp) ? $taxe->tp:'') ?? NULL}}">
</div>
<div class="form-group">
    <label for="type">Type de taxe à payer :</label>
    <input type="text" name="type" id="type" placeholder="exp: taxe sur débit de boisson" class="form-control"  value="{{old('type',isset($taxe->type) ? $taxe->type:'') ?? NULL}}">
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