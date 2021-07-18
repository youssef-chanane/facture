<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxe extends Model
{
    use HasFactory;
    protected $fillable=['tp','type','paiement','last_year','last_tranche','client_id','user_id'];
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function factures(){
        return $this->hasMany(Facture::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
