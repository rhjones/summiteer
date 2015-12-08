<?php

use Illuminate\Database\Seeder;

class PeakUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// get all of the hikes
    	$hikes = \App\Hike::with('peaks','user')->get();

        foreach($hikes as $hike) {

        	// get the user
        	$user = \App\User::find($hike->user_id);	
        	$peaks = [];
        	// get the peaks	
        	foreach ($hike->peaks as $peak) {
        		array_push($peaks,$peak->id);
        	}
        	
        	//$user->peaks()->attach($peaks);
        	$user->peaks()->sync($peaks, false);
        }
    }
}
