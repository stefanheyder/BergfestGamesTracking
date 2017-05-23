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


Route::get('/overview', function() {
    return view('Overview');
});

Route::get('/', function () {
    return view('leaderboard');
});

Route::get('/teams', function(){
    $teams = App\Team::all();
    return Response::json($teams->map(function(App\Team $team){
        return $team->name;
    })->sortByDesc('total'));
});

Route::get('/lifts', function() {
    $teams = App\Team::all();
    return Response::json($teams->map(function(App\Team $team) {
        return [
            'name' => $team->name,
            'lifts' => $team->lifts()
        ];
    }));
});
Route::get('/femaleLifts', function() {
    $teams = App\Team::all();
    return Response::json($teams->map(function(App\Team $team) {
        return [
            'name' => $team->name,
            'lifts' => App\Lift::where('team_id', $team->id)
                ->where('female', true)
                ->whereIn('Type', ['Squat', 'Deadlift', 'BenchPress'])
                ->get()
                ->pluck('Type')
        ];
    }));
});

Route::get('/timer', function() {
    $timer = App\Timer::where(['shouldStart' => true])->first();
    if (!isset($timer)) {
        return Response::json(['seconds' => 0]);
    }
    $timer->shouldStart = false;
    $timer->save();
    return Response::json(['seconds' => $timer->seconds]);
});
Route::put('timer/create/{seconds}', function($seconds) {
    // kdk timer
    App\Timer::create(["shouldStart" => true, "seconds" => $seconds]);
    // rest timer between sets
    App\Timer::create(["shouldStart" => true, "seconds" => 30]);
    // strongman timer
    App\Timer::create(["shouldStart" => true, "seconds" => $seconds]);
    return Redirect::back();
});
Route::get('timer/controls', function() {
    return view('TimerControls');
});

Route::get('kdk/{type}/{team_id}', function($type, $team_id) {
    if (!isKDKLift($type)){
        return isStrongManLift($type) ? Redirect::to('strong/' . $type . '/' . $team_id) : Redirect::back();
    }
    if (!collect(['bp', 'dl', 'sq'])->contains($type)) {
        return view('leaderboard');
    }
    $longType = liftTypeFromShort($type);
    return view('KDK', compact('type', 'team_id', 'longType'));
});

Route::put('kdk/{type}/{team_id}', function($type, $team_id) {
    $team = App\Team::find($team_id);
    if ($team) {
        $longType = liftTypeFromShort($type);
        $lift = $team->lift($longType);
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
        $lift = $team->lift($longType);
        $lift->amount = $lift->amount + 1;
        $lift->save();
    }
    return Redirect::back();
});

Route::get('lifts/{team}', function($team) {
    $team = is_numeric($team) ? App\Team::find($team) : App\Team::where('name', '=', $team)->first();
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

    $idOfTeam = function ($team) {
        return $team->id;
    };
    $byKDK = array_flip($teams->sortBy($scoringKDK)->map($idOfTeam)->toArray());
    $byStrong = array_flip($teams->sortBy($scoringStrong)->map($idOfTeam)->toArray());

    $total = $teams->mapWithKeys(function(App\Team $team) use($byKDK, $byStrong) {
        $kdkScore = $byKDK[$team->id];
        $strongScore = $byStrong[$team->id];

        return [$team->id => $kdkScore + $strongScore];
    });
    dd($byKDK, $byStrong, $total);

    return Response::json(['KDK' => $byKDK, 'Strong' => $byStrong]);
});
