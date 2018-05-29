<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLifterLiftingEventPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lifter_lifting_event', function (Blueprint $table) {
            $table->integer('lifter_id')->unsigned()->index();
            $table->foreign('lifter_id')->references('id')->on('lifters')->onDelete('cascade');
            $table->integer('lifting_event_id')->unsigned()->index();
            $table->foreign('lifting_event_id')->references('id')->on('lifting_events')->onDelete('cascade');
            $table->primary(['lifter_id', 'lifting_event_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lifter_lifting_event');
    }
}
