<div class="form-group">
    <label for="prenom">Annee : {{date('Y')}}</label>
    <select name="annee" id="annee" class="form-control">
        @for($i=date('Y')-10;$i<=date('Y');$i++)
            <option value="{{$i}}" {{($i==date('Y')) ? "selected":" "}}>{{$i}}</option>
        @endfor
    </select>
</div>

<div class="form-group">
    <label for="n_quetence">numéro de quetence :</label>
    <input type="text" name="n_quetence" id="n_quetence" class="form-control" >
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