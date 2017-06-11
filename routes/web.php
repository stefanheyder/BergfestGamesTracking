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


use Illuminate\Support\Facades\Input;

Route::get('/', function() {
    return view('Overview');
});

Route::get('/leaderboard', function () {
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
        return Response::json([]);
    }
    $timer->shouldStart = false;
    $timer->save();
    return Response::json(['start' => true]);
});

Route::get('/timer/start', function() {
    $timer = new App\Timer;
    $timer->shouldStart = true;
    $timer->save();
    return Redirect::back();
});

Route::get('lifts/{team}', function($team) {
    $team = is_numeric($team) ? App\Team::find($team) : App\Team::where('name', '=', $team)->first();
    if (isset($team)) {
        return Response::json($team->lifts());
    }
    return Response::json(null);
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
        $lift->female = Request::input('female') !== null;
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
