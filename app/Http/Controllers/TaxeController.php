<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Taxe;
use Illuminate\Http\Request;

class TaxeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes=Taxe::with('client')->get();
        return view('taxes.index',[
            'taxes'=>$taxes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients=Client::all();
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
            'tp'=>'required|numeric|unique:taxes',
            'type'=>'required',
            'cin'=>'required|exists:clients,cin'
        ]);
        $data=$request->only(['tp','type','paiement','last_year','last_tranche']);
        $client=Client::where('cin',$request->cin)->get();
        $clientId=$client->pluck('id');
        $data['client_id']=$clientId[0];
        $data['user_id']=$request->user()->id;
        Taxe::create($data);
        $request->session()->flash('success','taxe ajouter avec succes!');
        return redirect()->route('taxes.index');
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
        return view('taxes.edit',[
            'taxe'=>$taxe,
            'client'=>$taxe->client,
            'clients'=>Client::all()
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
            'tp'=>"required|numeric|unique:taxes,tp,$id",
            'type'=>'required',
            'cin'=>'required|exists:clients,cin'
        ]);
        $taxe=Taxe::find($id);
        $data=$request->only(['tp','type','paiement','last_year','last_tranche']);
        $client=Client::where('cin',$request->cin)->get();
        $clientId=$client->pluck('id');
        $data['client_id']=$clientId[0];
        $data['user_id']=$request->user()->id;
        $taxe->update($data);
        $request->session()->flash('success','taxe modifier avec succes!');
        return redirect()->route('taxes.index');
        
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
        $taxe->destroy($id);

        session()->flash('error','taxe supprimé');
        return redirect()->route('taxes.index');
    }
}
