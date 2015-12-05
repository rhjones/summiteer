<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function postLog(Request $request) {
        $this->validate($request, [
            'mileage' => 'numeric',
            'peaks' => 'required'
        ]);

        $hike = new \App\Hike();
        $hike->date_hiked = $request->date_hiked;
        $hike->mileage = $request->mileage;
        $hike->rating = $request->rating;
        $hike->notes = $request->notes;
        $hike->public = ($request->public == 'on' ? true : false);
        \Debugbar::info($hike->public);
        $hike->user_id = \Auth::id();
        $hike->save();

        // Add the peaks
        if($request->peaks) {
            $peaks = $request->peaks;
            dump($peaks);
        }
        else {
            $peaks = [];
        }

        $hike->peaks()->attach($peaks);

        \Session::flash('flash_message','Your hike was logged!');
        return redirect('/');
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