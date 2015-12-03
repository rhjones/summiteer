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
     * Responds to requests to GET /peaks/{name}
     */
    public function showPeak($name) {
        return view('peaks.peak')->with('name', $name);
    }

}