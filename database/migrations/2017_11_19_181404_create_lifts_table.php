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

            $table->integer('team_id')->default(0);

            $table->integer('discipline_id')->unsigned();
            $table->foreign('discipline_id')->references('id')->on('disciplines');

            $table->integer('lifter_id')->unsigned();
            $table->foreign('lifter_id')->references('id')->on('lifters');

            $table->integer('lifting_event_id')->unsigned();
            $table->foreign('lifting_event_id')->references('id')->on('lifting_events');

            $table->integer('positive_judged')->default(0);
            $table->integer('negative_judged')->default(0);

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

