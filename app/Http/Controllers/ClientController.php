<?php

namespace App\Http\Controllers;

use App\Http\Requests\client\RequestCreate;
use App\Http\Requests\client\RequestCreateClient;
use App\Http\Requests\client\RequestUpdateClient;
use App\Http\Requests\RequestClient;
use App\Models\Client;
use COM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClientController extends Controller
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
    public function index()
    {
        $clients=Client::all();
        return view('clients.index',[
            'clients'=>$clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
            "nom"=>"required|string",
            "prenom"=>"required|string",
            "cin"=>"required|unique:clients",
            "n_tel"=>"required|numeric|digits:10|unique:clients"
            ]);
        $data=$request->only(['nom','prenom','cin','n_tel']);
        $data['user_id']=$request->user()->id;
        
        $client=Client::create($data);

        $request->session()->flash('success','client ajouter avec success!');
        return redirect()->route('clients.index');
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
        $client=Client::find($id);
        $this->authorize('view',$client);
        return view('clients.edit',[
            'client'=>$client
            ]
        );
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
            "nom"=>"required|string",
            "prenom"=>"required|string",
            "cin"=>"required|unique:clients,cin,$id",
            "n_tel"=>"required|numeric|digits:10|unique:clients,n_tel,$id"
            ]);
        $client=Client::find($id);
        $this->authorize('view',$client);
        $data=$request->only(['nom','prenom','cin','n_tel']);
        $data['user_id']=$request->user()->id;
        
        $client->update($data);
        $request->session()->flash('success','client modifier avec succes!');

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client=Client::find($id);
        $this->authorize('view',$client);
        if($client->taxes->count()>0){
            session()->flash('error','tu ne peux pas suprimé ce client car il a des factures');
            return redirect()->back();
        }
        $client->destroy($id);

        session()->flash('error','le client est supprimé avec success');
        return redirect()->route('clients.index');
    }
}