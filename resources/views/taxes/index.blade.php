@extends('layouts.app')
@section('cssContent')
 <style>
    .search-button {
    background: url("chrome://browser/skin/forward.svg") no-repeat center center;
    /* background-size: auto; */
    /* background-size: auto; */
    background-size: 16px 16px;
    border: 0;
    border-radius: 0 3px 3px 0;
    /* -moz-context-properties: fill; */
    /* fill: var(--newtab-search-icon-color); */
    height: 100%;
    inset-inline-end: 0;
    position: absolute;
    width: 48px;
   }
</style>   
@endsection
@section('content')
    <div class="card">
        <div class="card-body">


            <div class="card-title">
                
                        <ul class="nav nav-tabs " style="margin-bottom: 2rem;">
                            <li class="nav-item">
                              <a  href="{{route('taxes.index')}}" class="nav-link @if($tag=='tous') active @endif" >tous</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link @if($tag=='trimestriel') active @endif" href="{{route('taxes.trimestriel')}}">trimestriel</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link @if($tag=='annuel') active @endif" href="{{route('taxes.annuel')}}">annuel</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link @if($tag=='mensuel') active @endif" href="{{route('taxes.mensuel')}}">mensuel</a>
                            </li>
                          </ul>
                          
                    <div class="row ">
                        <div class="col-5 mx-5">
                            <h4>
                                Dernier Facture Id : <span class="badge bg-danger text-light">{{$lastFactureId+1}}</span>
                            </h4>
                        </div>
                        <div class="col-4">
                            <form action="{{route('taxes.index')}}" method="GET" class="input-group">
                                <input type="text" value="{{request()->query('search')}}" class="form-control" name="search" placeholder="Chercher Taxe Professionnelle">
                                <input type="submit" class="search-button" value=" "/>
                             </form>
                        </div>
                        <div class="col-2">
                            <a href="{{route('taxes.create')}}" class="btn btn-success">ajouter taxe</a>
                        </div>
                    </div>
                </div>
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>type de taxe</th>
                    <th>Taxe Professionnelle</th>
                    <th>Régime</th>
                    <th>Nom du client</th>
                    <th>Dernier facture payé</th>
                    <th>Payé facture</th>
                    {{-- <th>imprimer facture</th> --}}
                    <th>Modifier le propriétaire </th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($taxes as $taxe)
                            <tr>
                                <td>{{$taxe->id}}</td>
                                <td>{{$taxe->type}}</td>
                                <td>{{$taxe->tp}}</td>
                                <td>{{$taxe->paiement}}</td>
                                <td>{{$taxe->client()->pluck('nom')[0]}} {{$taxe->client()->pluck('prenom')[0]}}</td>
                                <td class="{{($taxe->paiement=="mensuel")? "month$taxe->last_tranche":''}}"> {{($taxe->paiement=="trimestriel")?"trimestre $taxe->last_tranche":''}} {{($taxe->paiement=="mensuel")?"mois $taxe->last_tranche":''}} {{$taxe->last_year}}</td>
                                <td><a href="{{route('factures.create',$taxe->id)}}" class="btn btn-primary">payé</a></td>
                                {{-- <td>
                                        <a class="btn btn-warning" href="{{route('factures.show',$taxe->id)}}">imprimer</a>
                                </td> --}}
                                <td><a class="btn btn-success" href="{{route('taxes.edit',$taxe->id)}}">nvPropriétaire</a></td>
                                <td>
                                    <form action="{{route('taxes.destroy',$taxe->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="suprimmer" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
        
                    @endforeach
                </tbody>
            </table>        
        </div>
    </div>
    
@endsection
@section('scriptContent')
    <script>
        $(function(){
            const taxes=@json($taxes);
            console.log(taxes);
            const months=['janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre'];
            taxes.forEach(taxe => {
                if(taxe.paiement=="mensuel"){
                $('.month'+taxe.last_tranche).html(months[taxe.last_tranche-1]+" / "+taxe.last_year);
                console.log(taxe.last_tranche);
                }
                
            });

        })
    </script>

@endsection