<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="{{mix('js/scripts.js')}}"></script>
        <!-- <meta http-equiv="Refresh" content="5"> -->
        <!-- Fonts -->
        <link href="css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <example></example>
        <table class="table">
            <thead>
                <tr>
                    <td>Name</td>
                    @foreach(["BenchPress", "Deadlift", "Squat", "AtlasStone", "FarmerWalk", "TireFlip"] as $lift)
                        <td>{{$lift}}</td>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach(App\Team::all() as $team)
                <tr data="{{$team->id}}">
                    <td>
                        {{$team->name}}
                    </td>
                    @foreach(["BenchPress", "Deadlift", "Squat", "AtlasStone", "FarmerWalk", "TireFlip"] as $lift)
                        <td class="{{$lift}}">
                            {{$team->lifts()[$lift]}}
                        </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
