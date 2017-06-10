<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KDK Update für Team {{App\Team::find($team_id)->name}}</title>
</head>
<body>
    <div class="container">
        <div class="row h1 center-block">
            <div class="col-sm-12">

            </div>
            {{App\Team::find($team_id)->name}}: {{$longType}}
        </div>
        <div class="row h1 center-block">

            <div class="col-sm-3">
            </div>
            <div class="col-sm-3">
                Aktuell:
            </div>
            <div class="col-sm-3">
                <span class="label label-info">{{App\Team::find($team_id)->lifts()[$longType]}}</span>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
        <div class="row h1 center-block">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-3">
            </div>
            <div class="col-sm3">
                {{Form::open(['url' => 'strong/' . $type . '/' . $team_id, 'method' => 'PUT'])}}
                    <button type="submit" class="btn">+1</button>
                {{Form::close()}}
            </div>
            <div class="col-sm-3">
            </div>
        </div>
    </div>
</body>
</html>
