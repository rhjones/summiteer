<?php

use Illuminate\Database\Seeder;

class HikePeakTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{

	    # First, create an array of all the hikes we want to associate peaks with
	    # The *key* will be the hike id, and the *value* will be an array of peak ids.
	    $hikes = [
	        1 => [24, 34],
	        2 => [15, 19],
	        3 => [20, 40],
	        4 => [1, 2, 3, 4, 5, 11, 27],
	        5 => [14, 16],
	        6 => [23, 29, 39],
	        7 => [48],
	        8 => [10],
	        9 => [18, 25],
	        10 => [36]
	    ];

	    # Now loop through the above array, creating a new pivot for each book to tag
	    foreach($hikes as $hike_id => $peaks) {

	        # First get the hike
	        $hike = \App\Hike::where('id','like',$hike_id)->first();

	        # Now loop through each peak for this hike, adding the pivot
	        foreach($peaks as $peak_id) {
	            $peak = \App\Peak::where('id','like',$peak_id)->first();

	            # Connect this peak to this hike
	            $hike->peaks()->save($peak);
	        }

	    }
	}
}
