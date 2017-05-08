<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bergfest Games</title>
        <!-- <meta http-equiv="Refresh" content="5"> -->
        <!-- Fonts -->
        <link href="css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="app">
            <timer></timer>
            <leaderboard></leaderboard>
        </div>
        <script src="{{mix('js/app.js')}}"></script>
        <script src="{{mix('js/scripts.js')}}"></script>
    </body>
</html>
