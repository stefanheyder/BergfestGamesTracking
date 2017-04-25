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
