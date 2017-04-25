<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lifts', function (Blueprint $table) {
            $table->increments('id');
            $table->float('amount')->default(0);
            $table->enum('Type', [
                'BenchPress',
                'Deadlift',
                'Squat',
                'AtlasStone',
                'FarmerWalk',
                'TireFlip'
            ]);
            $table->integer('team_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lifts');
    }
}
