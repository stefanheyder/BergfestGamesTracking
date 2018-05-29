<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplineLiftingEventPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discipline_lifting_event', function (Blueprint $table) {
            $table->integer('discipline_id')->unsigned()->index();
            $table->foreign('discipline_id')->references('id')->on('disciplines')->onDelete('cascade');
            $table->integer('lifting_event_id')->unsigned()->index();
            $table->foreign('lifting_event_id')->references('id')->on('lifting_events')->onDelete('cascade');
            $table->primary(['discipline_id', 'lifting_event_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('discipline_lifting_event');
    }
}
