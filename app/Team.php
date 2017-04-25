<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name'
    ];

    public function lift($type) {
        $lift = Lift::where('team_id', $this->id)->where('Type', $type)->first();
        if(!isset($lift)) {
            $lift = new Lift;
            $lift->team_id = $this->id;
            $lift->Type = $type;
            $lift->amount = 0;
        }
        return $lift;
    }

    public function lifts() {
        $lifts = Lift::where('team_id', $this->id)->get()->sortBy('amount');

        $standardLifts = collect([
            'BenchPress' => 0,
            'Deadlift' => 0,
            'Squat' => 0,
            'AtlasStone' => 0,
            'FarmerWalk' => 0,
            'TireFlip' => 0,
        ]);
        $executedLifts = $lifts->mapWithKeys(function (Lift $lift) {
            return [$lift->Type => $lift->amount];
        });
        return $standardLifts->merge($executedLifts);
    }
}
