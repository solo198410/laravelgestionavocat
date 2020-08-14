<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Affaire extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo('App\User');
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
