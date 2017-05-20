<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KDK Update für Team {{App\Team::find($team_id)->name}}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
