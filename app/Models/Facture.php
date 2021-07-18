<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
    use HasFactory;
    public function taxe(){
        return $this->belongsTo(Taxe::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}