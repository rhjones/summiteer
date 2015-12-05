<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

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
            $today = date_create();
            $date_of_hike = date_create_from_format('Y-m-d', $hike->date_hiked);
            $diff = date_diff($date_of_hike, $today);
            if ($diff->d <  1) {
                $hike->date_hiked = $diff->format('%h hours');
            }
            else if ($diff->d === 1) {
                $hike->date_hiked = '1 day';
            }
            else if ($diff->m < 1) {
                $hike->date_hiked = $diff->format('%d days');
            }
            else if ($diff->m === 1) {
                $hike->date_hiked = $diff->format ('1 month');
            }
            else if ($diff->y < 1) {
                $hike->date_hiked = $diff->format ('%m months');
            }
            else if ($diff->y === 1) {
                $hike->date_hiked = $diff->format ('1 year');
            }
            else {
                $hike->date_hiked = $diff->format ('%y years');
            }
        }

        return view('peaks.peak')->with(['peak' => $peak, 'public_hikes' => $public_hikes]);
    }

}