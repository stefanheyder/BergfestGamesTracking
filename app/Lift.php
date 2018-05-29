<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lift extends Model
{

    public function discipline() {
        return $this->belongsTo('App\Discipline');
    }

    public function liftingEvent() {
        return $this->belongsTo('App\LiftingEvent');
    }

    public function lifter() {
        return $this->belongsTo('App\Lifter');
    }
}
