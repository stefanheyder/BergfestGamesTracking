<?php

use Illuminate\Database\Seeder;

class TimersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timers')->delete();
        DB::table('timers') ->insert(['shouldStart' => true, 'seconds' => 300]);
    }
}
