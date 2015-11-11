<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HikeController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /hike/{id}
    */
    public function getIndex($id = null) {
        return 'Display hike';
    }

    // public function getShow($title = null) {
    //     return view('books.show')->with('title', $title);
    // }


    /**
     * Responds to requests to GET /hike/log
     */
    public function getLog() {
        return 'Form to log a new hike';
    }

    /**
     * Responds to requests to POST /hike/log
     */
    public function postLog() {
        return 'Process adding new hike';
    }

    /**
     * Responds to requests to GET /hike/edit/{id}
     */
    public function getEdit() {
        return 'Form to edit hike';
    }

    /**
     * Responds to requests to POST /hike/edit/{id}
     */
    public function postEdit() {
        return 'Process form to edit hike';
    }

    /**
     * Responds to requests to POST /hike/delete/{id}
     */
    public function postDelete() {
        return 'Delete hike';
    }

}