<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHikePeakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hike_peak', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();

            # 'hike_id' and 'peak_id' will be foreign keys, so they have to be unsigned
            #  Note how the field names here correspond to the tables they will connect...
            # 'hike_id' will reference the 'hikes table' and 'peak_id' will reference the 'peaks' table.
            $table->integer('hike_id')->unsigned();
            $table->integer('peak_id')->unsigned();

            # Make foreign keys
            $table->foreign('hike_id')->references('id')->on('hikes');
            $table->foreign('peak_id')->references('id')->on('peaks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hike_peak');
    }
}
