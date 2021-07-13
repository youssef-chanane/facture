<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    protected $fillable=['nom','prenom','cin','n_tel','user_id'];
    public function taxes(){
        return $this->hasMany(Taxe::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
