<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class HomeController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /
    */
    public function getIndex() {
        $public_hikes = \App\Hike::where('public', 1)->with('peaks')->orderBy('date_hiked','DESC')->take(10)->get();

        foreach ($public_hikes as $hike) {
            $date_of_hike = Carbon::parse($hike->date_hiked);
            $hike->date_hiked = $date_of_hike->diffForHumans();
        }

        return view('welcome')->with(['public_hikes' => $public_hikes]);
    }


}