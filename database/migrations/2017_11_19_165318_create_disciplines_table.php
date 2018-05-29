<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplines', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->integer('tries')->default(1);
            $table->enum('scoring', ['weight', 'reps', 'time', 'distance', 'wilks', 'sinclair', 'none']);

            $table->boolean('is_judged');
            $table->integer('amount_of_judges');

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
        Schema::dropIfExists('disciplines');
    }
}
