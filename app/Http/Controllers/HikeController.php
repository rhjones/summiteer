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
    // public function getIndex($id = null) {
    //     return 'Display hike';
    // }

    /**
    * Responds to requests to GET /hike/show/{id}
    */
    public function getShow($id) {
        return view('hike.show')->with('id', $id);
    }


    /**
     * Responds to requests to GET /hike/log
     */
    public function getLog() {
        $peakModel = new \App\Peak();
        $peak_list = $peakModel->getPeakList();
        return view('hike.log')->with('peak_list',$peak_list);
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
    public function getEdit($id) {
        return view('hike.edit')->with('id', $id);
    }

    /**
     * Responds to requests to POST /hike/edit/{id}
     */
    public function postEdit() {
        return 'Process form to edit hike';
    }

    /**
     * 
     */
    public function getConfirmDelete($id) {
        return view('hike.delete')->with('id', $id);
    }

    /**
     * 
     */
    public function getDoDelete() {
        return 'Delete hike';
    }

}