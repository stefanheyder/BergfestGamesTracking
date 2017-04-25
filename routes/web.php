<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('kdk/{type}/{team_id}', function($type, $team_id) {
    if (!isKDKLift($type)){
        return isStrongManLift($type) ? Redirect::to('strong/' . $type . '/' . $team_id) : Redirect::back();
    }
    if (!collect(['bp', 'dl', 'sq'])->contains($type)) {
        return view('welcome');
    }
    $longType = liftTypeFromShort($type);
    return view('KDK', compact('type', 'team_id', 'longType'));
});

Route::put('kdk/{type}/{team_id}', function($type, $team_id) {
    $team = App\Team::find($team_id);
    if ($team) {
        $lift = new App\Lift;
        $lift->team_id = $team_id;
        $lift->type = liftTypeFromShort($type);
        $lift->amount = Request::input('amount');
        $lift->save();
    }
    return Redirect::back();
});

function liftTypeFromShort($short){
    switch($short) {
        case 'bp': {
            return 'BenchPress';
        }
        case 'dl': {
            return 'Deadlift';
        }
        case 'sq': {
            return 'Squat';
        }
        case 'as': {
            return 'AtlasStone';
        }
        case 'fw': {
            return 'FarmerWalk';
        }
        case 'tf': {
            return 'TireFlip';
        }
    }
}

function isStrongManLift($type) {
    return collect(['as', 'fw', 'tf'])->contains($type);
}

function isKDKLift($type) {
    return collect(['sq', 'dl', 'bp'])->contains($type);
}

Route::get('strong/{type}/{team_id}', function($type, $team_id) {
    if (!isStrongManLift($type)){
        return isKDKLift($type) ? Redirect::to('kdk/' . $type . '/' . $team_id) : Redirect::back();
    }
    $longType = liftTypeFromShort($type);
    return view('strongman', compact('type', 'team_id', 'longType'));
});

Route::put('strong/{type}/{team_id}', function($type, $team_id) {
    $team = App\Team::find($team_id);
    $longType = liftTypeFromShort($type);
    if ($team) {
        $lift = App\Lift::where('team_id', $team_id)->where('Type', $longType)->first();
        if (!isset($lift)) {
            $lift = new App\Lift;
            $lift->team_id = $team_id;
            $lift->Type = $longType;
        }
        $lift->amount = $lift->amount + 1;
        $lift->save();
    }
    return Redirect::back();
});

Route::get('lifts/{team_id}', function($team_id) {
    $team = App\Team::find($team_id);
    if (isset($team)) {
        return Response::json($team->lifts());
    }
    return Response::json(null);
});

Route::get('scores', function() {
    $teams = App\Team::all();
    $scoringKDK = function(App\Team $team) {
        $lifts = $team->lifts();
        return $lifts['BenchPress'] + $lifts['Squat'] + $lifts['Deadlift'];
    };

    $scoringStrong = function(App\Team $team) {
        $lifts = $team->lifts();
        return $lifts['AtlasStone'] + $lifts['TireFlip'] + $lifts['FarmerWalk'];
    };
    $nameOfTeam = function ($team) {
        return $team->name;
    };
    $byKDK = $teams->sortBy($scoringKDK)->map($nameOfTeam)->toArray();
    $byStrong = $teams->sortBy($scoringStrong)->map($nameOfTeam)->toArray();

    return Response::json(['KDK' => $byKDK, 'Strong' => $byStrong]);
});
