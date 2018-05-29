<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lifter extends Model
{
    public function events()
    {
        return $this->belongsToMany('App\LiftingEvent');
    }
}
