<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avocat extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function skills(){
        return $this->hasMany('App\Skill');
    }

    public function details(){
        return $this->hasMany('App\Detail');
    }

    public function wilaya(){
        return $this->belongsTo('App\Wilaya');
    }
}
