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
    @php($isKDK = App\Utilities::isKDKLift($liftName))
    @php($lift = App\Team::find($team_id)->lift($liftName))
    <div class="container">
        <div class="row">
            <div class="col-xs-12" style="text-align: center; font-size: 20px;">
                <b>{{ $liftName }} -- {{ App\Team::find($team_id)->name }} </b>
            </div>
        </div>
        <div class="row ">
            @if(! $isKDK)
                <div class="col-xs-12" style="font-size:150px;text-align:center">{{$lift->amount}}</div>
            @endif
        </div>
        <div class="row ">
            {{ Form::open(['url' => 'lift/' . $liftName . '/' . $team_id, 'method' => 'PUT', "class" => "col-xs-12"]) }}
                {{ Form::input($isKDK ? "text" : "hidden", 'amount', $isKDK ? $lift->amount : $lift->amount + 1, [ "style" => "font-size:120px;text-align:center;border-radius:10px", "class" => "col-xs-12"])}}
                @if($isKDK)
                    <div class="col-xs-12" style="font-size:50px; text-align:center">
                        <label>
                            <input type="checkbox" name="female" id="female"  style="width:40px;height:40px" {{ $lift->female ? "checked" : "" }}>
                            Weiblich
                        </label>
                    </div>
                @endif
                {{ Form::submit($isKDK? "Update" : "+1 " , ["class" => "btn btn-primary col-xs-12", "style" => "font-size:80px;white-space:normal"] ) }}
            {{ Form::close() }}
        </div>
        <div class="row" >
            <div class="btn-group col-xs-12">
                @if($isKDK)
                    @foreach([2.5, 5, 10, 20, 30, 40] as $increment)
                        <button type="button" class="btn btn-secondary col-xs-4" style="font-size:40px;" onclick="document.getElementsByName('amount')[0].value = parseFloat(document.getElementsByName('amount')[0].value) + {{$increment}}">+ {{$increment}}</button>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="row">
            {{Form::open(['url' => 'lift/reset/' . $liftName . '/' . $team_id, 'method' => 'PUT', "class" => "col-xs-12"])}}
                <button type="submit" class="btn btn-primary col-xs-12" style="font-size:30px">Rückgängig({{$lift->previous_amount}})</button>
            {{Form::close()}}
        </div>
        @php($nextLifts = \App\Utilities::isStrongManLift($liftName) ? \App\Utilities::$kdkLifts : \App\Utilities::$strongmanLifts)
        <div class="row">
            <div class="btn-group col-xs-12">
                @foreach($nextLifts as $nextLift)
                    <a href="/lift/{{ $nextLift }}/{{$team_id}}" class="btn btn-default col-md-4 col-xs-12" style="font-size:50px"> {{ \App\Utilities::readableName($nextLift) }}</a>
                @endforeach
            </div>
        </div>
        @php($next = App\Team::where('id', '>', $team_id)->orderBy('id')->first())
        @php($previous = App\Team::where('id', '<', $team_id)->orderBy('id', 'desc')->first())
        @if(isset($next))
            <div class="row">
                <div class="col-xs-12">
                    <a href="/lift/{{$liftName}}/{{$next->id}}/" class="btn btn-warning col-xs-12" style="font-size:30px">Nächstes Team</a>
                </div>
            </div>
        @endif
        @if(isset($previous))
            <div class="row">
                <div class="col-xs-12">
                    <a href="/lift/{{$liftName}}/{{App\Team::where('id', '<', $team_id)->orderBy('id', 'desc')->first()->id}}/" class="btn btn-warning col-xs-12" style="font-size:30px">Vorheriges Team</a>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-xs-12">
                <a href="/" class="btn btn-warning col-xs-12" style="font-size:30px">Übersicht</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <a href="/timer/start" class="btn btn-warning col-xs-12" style="font-size:30px">Start Timer</a>
            </div>
        </div>
    </div>
</body>
</html>
