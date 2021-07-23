<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function avocat(){
        return $this->belongsTo('App\Avocat');
    }
}
