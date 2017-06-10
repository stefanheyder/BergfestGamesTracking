<?php
namespace App;

class Utilities
{

    public static $strongmanLifts = ["Burpee", "TireFlip", "FarmerWalk"];
    public static $kdkLifts = ["Squat", "BenchPress", "Deadlift"];

    public static function isStrongManLift($type) {
        return collect(self::$strongmanLifts)->contains($type);
    }

    public static function isKDKLift($type) {
        return collect(self::$kdkLifts)->contains($type);
    }

    public static function readableName($lift) {
        $pieces = preg_split('/(?=[A-Z])/', $lift);
        return implode(" ", $pieces);
    }
}