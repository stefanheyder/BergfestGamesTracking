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
                [ 'name' => 'Atlético zu Dritt'],
                [ 'name' => 'Fail am Platz'],
                [ 'name' => 'Movement 2k17'],
                [ 'name' => 'Burpees? Nein, Bier please!'],
                [ 'name' => 'Blue Muffins :D'],
                [ 'name' => 'Ghettoworkout e.V.'],
                [ 'name' => 'MMA'],
                [ 'name' => 'Chillers Of The Miller Killer']
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
