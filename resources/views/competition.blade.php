@extends('layouts.master')
@section('content')
    <div class="col-md-2">
        <div class="row">
            <div class="col-md-4"> Platz </div>
            <div class="col-md-4"> Name </div>
            <div class="col-md-4"> Weight </div>
        </div>
        @foreach($competition->lifters as $lifter)
            <div class="row">
                <div class="col-md-4"> 1 </div>
                <div class="col-md-4"> {{ $lifter->name }} </div>
                <div class="col-md-4"> {{ $lifter->weight }} </div>
            </div>
        @endforeach
    </div>
    @foreach($competition->disciplines as $discipline)
        <div class="col-md-2">
            <div class="row">
                {{ $discipline->name }}
            </div>
            <div class="row">
                @foreach($discipline->lifts as $lift)
                    <div class="col-md-4">
                        {{ $lift->amount }}
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
@stop
