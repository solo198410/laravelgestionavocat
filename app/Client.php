<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function affaire(){
        return $this->belongsTo('App\Affaire');
    }

    public function type(){
        return $this->belongsTo('App\Type');
    }
}
