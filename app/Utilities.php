<?php
namespace App;

class Utilities
{

    public static $strongmanLifts = ["Burpee", "TireFlip", "FarmerWalk"];
    public static $kdkLifts = ["Squat", "BenchPress", "Deadlift"];

    public static $shortToLong = [
        "bp" => "BenchPress",
        "sq" => "Squat",
        "dl" => "Deadlift",
        "as" => "Burpee",
        "fw" => "FarmerWalk",
        "tf" => "TireFlip",
    ];

    public static $longToShort = [
        "BenchPress" => "bp",
        "Squat" => "sq",
        "Deadlift" => "dl",
        "Burpee" => "as",
        "FarmerWalk" => "fw",
        "TireFlip" => "tf",
    ];

    public static function liftTypeFromShort($short){
        return self::$shortToLong[$short];
    }

    public static function shortFromLiftType($long) {
        return self::$longToShort[$long];
    }

    public static function isStrongManLift($type) {
        return collect(['as', 'fw', 'tf', "Burpee", "FarmerWalk", "TireFlip"])->contains($type);
    }

    public static function isKDKLift($type) {
        return collect(['sq', 'dl', 'bp', "Squat", "BenchPress", "Deadlift"])->contains($type);
    }

}