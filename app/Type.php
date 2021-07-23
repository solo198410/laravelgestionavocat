<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function clients(){
        return $this->hasMany('App\Client');
        
    }
}
