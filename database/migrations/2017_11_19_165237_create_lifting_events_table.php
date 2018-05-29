<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiftingEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lifting_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('scoring_from_disciplines', ['wilks', 'sinclair', 'total', 'points_per_discipline']);
            $table->timestamps();
            $table->boolean('is_template')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lifting_events');
    }
}
