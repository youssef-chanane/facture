<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Taxe;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class FactureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(Taxe $taxe){
        $client=$taxe->client;
        $this->authorize('view',$taxe);
        return view("factures.create",[
            "taxe"=>$taxe,
            "client"=>$client
        ]);
    }
    public function store(Request $request,Taxe $taxe){
        $this->authorize('view',$taxe);
        $request->validate([
            'n_quetence'=>"required|numeric|gt:0|unique:factures",
            'montant'=>"required|numeric|gt:0",

    ]);
        $data=$request->only(['annee','tranche','n_quetence','montant']);
        $data['taxe_id']=$taxe->id;
        $data['user_id']=$taxe->user_id;
        $facture=Facture::create($data);
        $taxe->last_year=$request->annee;
        $taxe->last_tranche=$request->tranche;
        $taxe->save();
        return redirect()->route('taxes.index',["taxes"=>Taxe::all()]);
    }

    // public function show(Facture $facture){
    //       $pdf = PDF::loadView('factures.show',['facture'=>$facture]);
    //       return $pdf->download('facture_N'.$facture->n_quetence.'.pdf');
    // }
}
