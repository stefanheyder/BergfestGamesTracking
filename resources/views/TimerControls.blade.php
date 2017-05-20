<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Timer Kontrolle</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    {{Form::open(['url' => 'timer/create/180', 'method' => 'PUT'])}}
        <button type="submit"> Neue Runde </button>
    {{Form::close()}}
    {{Form::open(['url' => 'timer/create/30', 'method' => 'PUT'])}}
    <button type="submit"> Pause zwischen den Runden</button>
    {{Form::close()}}
</body>
</html>

