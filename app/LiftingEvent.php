<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiftingEvent extends Model
{
    public function disciplines() {
        return $this->belongsToMany('App\Discipline');
    }

    public function lifts() {
        return $this->hasMany('App\Lift');
    }

    public function lifters() {
        return $this->belongsToMany('App\Lifter');
    }
}
