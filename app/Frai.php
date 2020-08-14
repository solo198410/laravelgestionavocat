<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frai extends Model
{
    public function affaire(){
        return $this->belongsTo('App\Affaire');
    }
}
