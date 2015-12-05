<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PeakController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /peaks
    */
    public function getIndex() {
        $peaks = \App\Peak::orderBy('elevation','DESC')->get();
        return view('peaks.index')->with('peaks',$peaks);
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