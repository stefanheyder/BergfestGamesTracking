<div class="panel-heading">
    <div class="panel-title">
        {{ $team->name }}
    </div>
</div>
<div class="panel-body container">
    <div class="row">
        @foreach (["Squat", "BenchPress", "Deadlift", "AtlasStone", "FarmerWalk", "TireFlip"] as $lift)
            <div class="col-md-2 col-xs-6">
                <div class="row">
                    <div class="col-xs-12 text-center" style="font-size:25px">
                        {{$lift}}
                    </div>
                    <div class="col-xs-12 text-center" style="font-size:25px; font-style:bold">
                        {{ $lifts[$lift] }}
                    </div>
                </div>
                <div class="row">
                    <a class="btn btn-warning col-xs-12" href="/lift/{{$lift}}/{{$team->id}}">Edit</a>
                </div>
            </div>
        @endforeach
    </div>
</div>