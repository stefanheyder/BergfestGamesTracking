<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameAtlasStoneToBurpee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE lifts CHANGE COLUMN Type Type ENUM('BenchPress', 'Deadlift', 'Squat', 'Burpee', 'FarmerWalk', 'TireFlip')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE lifts CHANGE COLUMN Type Type ENUM('BenchPress', 'Deadlift', 'Squat', 'AtlasStone', 'FarmerWalk', 'TireFlip')");
    }
}
