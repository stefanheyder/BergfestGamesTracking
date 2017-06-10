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

Route::get('lifts/{team}', function($team) {
    $team = is_numeric($team) ? App\Team::find($team) : App\Team::where('name', '=', $team)->first();
    if (isset($team)) {
        return Response::json($team->lifts());
    }
    return Response::json(null);
});

Route::get("lift/{liftName}/{team_id}", function($liftName, $team_id) {
    return view('EditLift', compact('liftName', 'team_id'));
});

Route::put("lift/{liftName}/{team_id}", function($liftName, $team_id) {
    $team = App\Team::find($team_id);
    if ($team) {
        $lift = $team->lift($liftName);
        $lift->previous_amount = $lift->amount;
        $lift->amount = Request::input('amount');
        $lift->save();
    }
    return Redirect::back();
});

Route::put("lift/reset/{liftName}/{team_id}", function($liftName, $team_id) {
    $team = App\Team::find($team_id);
    if ($team) {
        $lift = $team->lift($liftName);
        $lift->amount = $lift->previous_amount;
        $lift->save();
    }
    return Redirect::back();
});
