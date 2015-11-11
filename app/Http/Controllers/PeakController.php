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
        return 'List all the peaks';
    }

    /**
     * Responds to requests to GET /peaks/{name}
     */
    public function getShow($name = null) {
        return 'Individual peak page';
        // return view('peaks.show')->with('name', $name);
    }

}