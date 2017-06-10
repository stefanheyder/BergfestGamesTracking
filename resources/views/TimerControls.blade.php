<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Timer Kontrolle</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                {{Form::open(['url' => 'timer/create/180', 'method' => 'PUT'])}}
                    <button type="submit" class="btn btn-primary"> Neue Runde </button>
                {{Form::close()}}
            </div>
        </div>
    </div>
</body>
</html>

