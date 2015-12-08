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

        if(\Auth::check()) {
            $user = \App\User::with('peaks')->find(\Auth::id());
            $user_peaks = $user->peaks;
            $peaks_summitted = [];
            foreach($user_peaks as $peak) {
                array_push($peaks_summitted,$peak->id);
            }
        }
        return view('peaks.index')->with(['peaks' => $peaks, 'peaks_summitted' => $peaks_summitted]);
    }

    /**
     * Responds to requests to GET /peaks/{id}
     */
    public function showPeak($id) {
        
        $peak = \App\Peak::where('id',$id)->with('hikes.user')->first();

        $public_hikes = $peak->hikes->where('public',1);

        foreach ($public_hikes as $hike) {
            $date_of_hike = Carbon::parse($hike->date_hiked);
            $hike->date_hiked = $date_of_hike->diffForHumans();
        }

        return view('peaks.peak')->with(['peak' => $peak, 'public_hikes' => $public_hikes]);
    }

}