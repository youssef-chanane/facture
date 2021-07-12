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
        $data=$request->only(['nom','prenom','cin','n_tel']);
        $data['user_id']=$request->user()->id;
        $request->validate([
            "nom"=>"required|string",
            "prenom"=>"required|string",
            "cin"=>"required|unique:clients,cin,NULL,id,deleted_at,NULL",
            "n_tel"=>"required|numeric|digits:10|unique:clients,n_tel,NULL,id,deleted_at,NULL"
            ]);
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
        return view('clients.edit',[
            'client'=>Client::find($id)]
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
        $client=Client::find($id);
        $data=$request->only(['nom','prenom','cin','n_tel']);
        $data['user_id']=$request->user()->id;
        $request->validate([
        "nom"=>"required|string",
        "prenom"=>"required|string",
        "cin"=>"required|unique:clients,cin,$id,id,deleted_at,NULL",
        "n_tel"=>"required|numeric|digits:10|unique:clients,n_tel,$id,id,deleted_at,NULL"
        ]);
        $client->update($data);
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
        Client::destroy($id);
        session()->flash('success','le client est supprimé avec success');
        return redirect()->route('clients.index');
    }
}