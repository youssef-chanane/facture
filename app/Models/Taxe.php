<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxe extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function dates(){
        return $this->hasMany(Date::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
