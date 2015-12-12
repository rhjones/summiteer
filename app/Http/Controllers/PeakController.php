<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;

class PeakController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /peaks
    */
    public function getIndex() {
        $peaks = \App\Peak::orderBy('elevation','DESC')->get();
        $peaks_summitted = [];
        if(\Auth::check()) {
            $user = \App\User::with('peaks')->find(\Auth::id());
            $user_peaks = $user->peaks;
            foreach($user_peaks as $peak) {
                array_push($peaks_summitted,$peak->id);
            }
        }
        foreach($peaks as $peak) {
            if(in_array($peak->id,$peaks_summitted)) {
                $peak->summitted = 1;
            }
        }
        return view('peaks.index')->with(['peaks' => $peaks, 'peaks_summitted' => $peaks_summitted]);
    }

    /**
     * Responds to requests to GET /peaks/{id}
     */
    public function showPeak($id) {
        
        $peak = \App\Peak::where('id',$id)->with('hikes.user')->first();

        if(is_null($peak)) {
            \Session::flash('flash_message','Peak not found.');
            return redirect('/peaks');
        }

        $public_hikes = $peak->hikes->where('public',1);

        dump($public_hikes);

        // foreach ($public_hikes as $hike) {
        //     $date_of_hike = Carbon::parse($hike->date_hiked);
        //     $hike->date_hiked = $date_of_hike->diffForHumans();
        // }

        // return view('peaks.peak')->with(['peak' => $peak, 'public_hikes' => $public_hikes]);
    }

}