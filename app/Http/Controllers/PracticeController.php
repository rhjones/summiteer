<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PracticeController extends Controller {
    
    function getExample1() {
        $carbondate = Carbon::now()->toRfc2822String();

        dump($carbondate);
    }

    function getExample2() {
        $user = \App\User::where('username', 'jillharvard')->first();
        dump($user->hikes);
    }

    function getExample3() {

   		$hikes = \App\Hike::with('peaks','user')->get();

        $peaks_users = [];


        foreach($hikes as $hike) {

        	$peak_user['user'] = $hike->user_id;
        		
        	// get the user
        	//$user = \App\User::find($hike->user_id);

        	// get the peaks	
        	foreach ($hike->peaks as $peak) {
        		//$peak = \App\Peak::find($peak);

        		$peak_user['peak'] = $peak->id;

        		array_push($peaks_users,$peak_user);

        		// connect this peak to this user	
        		//$user->peaks()->firstOrCreate($peak);
        	}
        	
        	
        }

        dump($peaks_users);
        
    }

    function getExample4() {

        // get all of the hikes
        $hikes = \App\Hike::with('peaks','user')->get();

        // returns 10 hikes

        foreach($hikes as $hike) {

            // get the user
            $user = \App\User::find($hike->user_id);  
            // this gets a user 10 different times, as it should

            $peaks = [];
            // get the peaks    
            foreach ($hike->peaks as $peak) {
                array_push($peaks,$peak->id);
            }

            dump($peaks);
            // $user->peaks()->attach($peaks);
        }

    }


    function getExample5() {

        $user_id = 1;
        $user = \App\User::with('peaks')->find($user_id);
        $user_peaks = $user->peaks;
        $count = count($user_peaks);
        dump($count);

    }
		
}