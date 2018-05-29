<?php

use App\Discipline;
use App\Lifter;
use App\LiftingEvent;
use Illuminate\Database\Seeder;

class PowerliftingEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kdk = new LiftingEvent([
            'name' => 'Kraftdreikampf',
            'scoring_from_disciplines' => 'wilks',
            'is_template' => true
        ]);
        $kdk->save();

        $squat = new Discipline([
            'name' => 'Kniebeuge',
            'tries' => 3,
            'scoring' => 'none',
            'is_judged' => true,
            'amount_of_judges' => 3
        ]);
        $bench = new Discipline([
            'name' => 'Bankdrücken',
            'tries' => 3,
            'scoring' => 'none',
            'is_judged' => true,
            'amount_of_judges' => 3
        ]);

        $deadlift = new Discipline([
            'name' => 'Kreuzheben',
            'tries' => 3,
            'scoring' => 'none',
            'is_judged' => true,
            'amount_of_judges' => 3
        ]);
        $squat->save();
        $bench->save();
        $deadlift->save();

        $kdk->disciplines()->sync([$squat->id, $bench->id, $deadlift->id]);

        $lifter = Lifter::create([
            'name' => 'Default Lifter',
            'weight' => 80,
            'birthday' => date('Y-m-d')
        ]);

        $kdk->lifters()->sync([$lifter->id]);

        $lift = new App\Lift();
        $lift->amount = 100;
        $lift->discipline()->associate($squat);
        $lift->liftingEvent()->associate($kdk);
        $lift->lifter()->associate($lifter);
        $lift->save();
    }
}
