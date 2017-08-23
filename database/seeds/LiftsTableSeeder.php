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
            App\Team::all()->each(function(App\Team $team) use ($faker, $liftRanges) {
                foreach ([1,2,3] as $number) {
                    $isFemale = $faker->boolean(10);
                    DB::table('lifts')->insert(
                        collect($this->getLiftsOfLifter($number))
                            ->map(function($lift) use ($team, $liftRanges, $isFemale, $faker) {
                                $range = $liftRanges[$isFemale ? "female" : "male"][$lift];
                                $amount = $faker->numberBetween($range["min"], $range["max"]);
                                return [
                                    'Type'      => $lift,
                                    'team_id'   => $team->id,
                                    'amount'    => $amount,
                                    'previous_amount'    => $amount - 5,
                                    'female'    => $isFemale
                                ];
                            })
                            ->toArray()
                    );
                }
            });
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
