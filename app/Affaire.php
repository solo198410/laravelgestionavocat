<?php

namespace App;
//use App\Autoritesjudiciaire;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Affaire extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function autoritesjudiciaire(){
        return $this->belongsTo('App\Autoritesjudiciaire');
    }

    public function clients(){
        return $this->hasMany('App\Client');
    }

    public function seances(){
        return $this->hasMany('App\Seance');
    }

    public function decisions(){
        return $this->hasMany('App\Decision');
    }
    public function frais(){
        return $this->hasMany('App\Frai');
    }
}
