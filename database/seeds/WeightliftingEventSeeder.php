<?php

use App\LiftingEvent;
use App\Discipline;

use Illuminate\Database\Seeder;

class WeightliftingEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weightlifting = new LiftingEvent([
            'name' => 'Gewichtheben',
            'scoring_from_disciplines' => 'sinclair',
            'is_template' => true
        ]);
        $weightlifting->save();

        $snatch = new Discipline([
            'name' => 'Reißen',
            'tries' => 3,
            'scoring' => 'none',
            'is_judged' => true,
            'amount_of_judges' => 3
        ]);
        $cleanAndJerk = new Discipline([
            'name' => 'Stoßen',
            'tries' => 3,
            'scoring' => 'none',
            'is_judged' => true,
            'amount_of_judges' => 3
        ]);
        $snatch->save();
        $cleanAndJerk->save();

        $weightlifting->disciplines()->sync([$snatch->id, $cleanAndJerk->id]);
    }
}
