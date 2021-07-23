<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autoritesjudiciaire extends Model
{
    public function affaires(){
        return $this->hasMany('App\Affaire');
    }
}
