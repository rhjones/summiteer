<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeletePeakUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('peak_user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('peak_user', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();

            # `book_id` and `tag_id` will be foreign keys, so they have to be unsigned
            #  Note how the field names here correspond to the tables they will connect...
            # `peak_id` will reference the `peaks table` and `user_id` will reference the `users` table.
            $table->integer('peak_id')->unsigned();
            $table->integer('user_id')->unsigned();

            # Make foreign keys
            $table->foreign('peak_id')->references('id')->on('peaks');
            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }
}
