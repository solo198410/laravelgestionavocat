<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    public function avocats(){
        return $this->hasMany('App\Avocat');
    }
}
