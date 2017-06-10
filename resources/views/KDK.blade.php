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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    {{Form::open(['url' => 'kdk/' . $type . '/' . $team_id, 'method' => 'PUT'])}}
        {{App\Team::find($team_id)->lifts()[$longType]}}
        <input type="text" placeholder="{{$longType}}" name="amount">
        <button type="submit"> Submit</button>
    {{Form::close()}}
    @foreach(\App\Utilities::$strongmanLifts as $strong)
        <a href="/strong/{{\App\Utilities::shortFromLiftType($strong)}}/{{$team_id}}" class="btn btn-default"> {{ $strong }}</a>
    @endforeach
</body>
</html>

