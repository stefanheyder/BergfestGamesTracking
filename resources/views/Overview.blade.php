<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Überblick</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <ul class="nav nav-tabs">
        @foreach(App\Team::all() as $team)
            <li class="{{$loop->first ? "active" : ""}}" data-toggle="tab">
                <a href="#team{{$team->id}}">
                    {{$team->name}}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        @foreach(App\Team::all() as $team)
            <div id="team{{$team->id}}" class="tab-pane fade {{$loop->first ? "active" : ""}}">
                <div class="row ">
                    Lifts
                </div>
                <div class="row">
                    <div class="col">
                        Squat : {{$team->lifts()["Squat"]}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
