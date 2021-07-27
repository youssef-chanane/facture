<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use App\Models\Taxe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        $search=$request->query('search');
        if($search){
            $taxes=Taxe::where('user_id',Auth::id())->where('tp','LIKE',"%{$search}%")->with('client')->get();
        }else{
            $taxes=Taxe::where('user_id',Auth::id())->with('client')->get();
        }

        return view('taxes.index',[
            'taxes'=>$taxes,
            'tag'=>'tous'
        ]);
    }
    //juste payé par trimestre
    public function trimestriel(){
       
        $taxes=Taxe::where('user_id',Auth::id())->where('paiement','=','trimestriel')->with('client')->orderBY('last_year')->orderBy('last_tranche')->get();
        return view('taxes.index',[
            'taxes'=>$taxes,
            'tag'=>'trimestriel'
        ]);
        
    }
    //juste payé par mois
    public function mensuel(){
       
        $taxes=Taxe::where('user_id',Auth::id())->where('paiement','=','mensuel')->with('client')->orderBY('last_year')->orderBy('last_tranche')->get();
        // dd($taxes);
        return view('taxes.index',[
            'taxes'=>$taxes,
            'tag'=>'mensuel'
        ]);
    }
    //juste payé annuelement
    public function annuel(){
        
        $taxes=Taxe::where('user_id',Auth::id())->where('paiement','=','annuel')->with('client')->orderBY('last_year')->orderBy('last_tranche')->get();
        // dd($taxes);
        return view('taxes.index',[
            'taxes'=>$taxes,
            'tag'=>'annuel'
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients=Client::where('user_id',Auth::id())->get();
        return view('taxes.create',[
            "clients"=>$clients
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tp'=>'required|numeric|gt:0|unique:taxes',
            'type'=>'required',
            'cin'=>'required|exists:clients,cin'
        ]);
        $data=$request->only(['tp','type','paiement','last_year','last_tranche']);
        $client=Client::where('cin',$request->cin)->get();
        $clientId=$client->pluck('id');
        $data['client_id']=$clientId[0];
        $data['user_id']=$request->user()->id;

        //verifier si le cient entré est crée par le meme utilisateur 
        if($client->pluck('user_id')[0]==Auth::id()){
            Taxe::create($data);
            $request->session()->flash('success','taxe ajouter avec succes!');
            return redirect()->route('taxes.index'); 
        }else{
            $request->session()->flash('error','entrer un utilisateur valide');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $taxe=Taxe::find($id);
        $this->authorize('view',$taxe);
        $clients=Client::where('user_id',Auth::id())->get();
        // dd($clients[0]->nom);
        return view('taxes.edit',[
            'taxe'=>$taxe,
            'client'=>$taxe->client,
            'clients'=>$clients
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cin'=>'required|exists:clients,cin'
        ]);
        $taxe=Taxe::find($id);
        $this->authorize('view',$taxe);
        $data=$request->only(['tp','type','paiement','last_year','last_tranche']);
        $client=Client::where('cin',$request->cin)->get();
        $clientId=$client->pluck('id');
        $data['client_id']=$clientId[0];
        $data['user_id']=$request->user()->id;
        //verifier si le client entré est crée par le meme utilisateur 
        if($client->pluck('user_id')[0]==Auth::id()){
            $taxe->update($data);
            $request->session()->flash('success','propriétaire modifier avec succes!');
            return redirect()->route('taxes.index');
        }else{
            $request->session()->flash('error','entrer un utilisateur valide');
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taxe=Taxe::find($id);
        $this->authorize('view',$taxe);
        $taxe->destroy($id);

        session()->flash('error','taxe supprimé');
        return redirect()->route('taxes.index');
    }
}
