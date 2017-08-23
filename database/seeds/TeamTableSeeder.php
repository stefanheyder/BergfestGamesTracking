<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->delete();
        if (App::environment('local')) {
            DB::table('teams')->insert([
                ['name' => '1st Team'],
                ['name' => '2nd Team'],
                ['name' => '3rd Team'],
                ['name' => '4th Team'],
                ['name' => '5th Team'],
                ['name' => '6th Team'],
                ['name' => '7th Team'],
                ['name' => '8th Team'],
                ['name' => '9th Team'],
                ['name' => '10th Team'],
                ['name' => '11th Team']
            ]);
        }
        else {
            $teamsAsString = File::get(storage_path('data/teams'));
            foreach(explode("\n", $teamsAsString) as $team) {
                if (strlen($team) > 0) {
                    DB::table('teams')->insert([
                        'name' => $team
                    ]);
                }
            }
        }
    }
}
