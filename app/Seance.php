<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    public function affaire(){
        return $this->belongsTo('App\Affaire');
    }
}
