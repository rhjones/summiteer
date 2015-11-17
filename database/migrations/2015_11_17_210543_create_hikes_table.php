<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hikes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('date_hiked');
            $table->decimal('mileage', 5, 2);
            $table->integer('rating');
            $table->text('notes');
            $table->boolean('public');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hikes');
    }
}
