<?php

use Illuminate\Database\Seeder;

class LiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $liftRanges = [
            "male" => [
                "BenchPress"    => ["min" => 50, "max" => 120],
                "Squat"         => ["min" => 120, "max" => 200],
                "Deadlift"      => ["min" => 140, "max" => 250],
                "Burpee"    => ["min" => 10, "max" => 30],
                "TireFlip"      => ["min" => 20, "max" => 40],
                "FarmerWalk"    => ["min" => 5, "max" => 20]
            ],
            "female" => [
                "BenchPress"    => ["min" => 25, "max" => 60],
                "Squat"         => ["min" => 40, "max" => 70],
                "Deadlift"      => ["min" => 50, "max" => 100],
                "Burpee"    => ["min" => 10, "max" => 30],
                "TireFlip"      => ["min" => 20, "max" => 40],
                "FarmerWalk"    => ["min" => 5, "max" => 20]
            ]
        ];

        DB::table('timers')->delete();
        $faker = \Faker\Factory::create();
        if (App::environment('local')) {
        }
    }

    public function getLiftsOfLifter($lifterNumber) {
        switch ($lifterNumber) {
            case 1 :
                return ["BenchPress", "Burpee"];
            case 2:
                return ["Squat", "TireFlip"];
            case 3:
                return ["Deadlift", "FarmerWalk"];
        }
    }
}
