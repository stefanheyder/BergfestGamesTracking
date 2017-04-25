<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lift extends Model
{
    protected $fillable = [
        'amount',
        'Type',
        'team_id'
    ];
}
