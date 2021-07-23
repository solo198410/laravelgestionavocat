<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public function avocat(){
        return $this->belongsTo('App\Avocat');
    }

    public function typedetail(){
        return $this->belongsTo('App\Typedetail');
    }
}
