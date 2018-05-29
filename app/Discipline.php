<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    public function events() {
        return $this->belongsToMany('App\LiftingEvent');
    }

    public function lifts()
    {
        return $this->hasMany('App\Lift');
    }
}
