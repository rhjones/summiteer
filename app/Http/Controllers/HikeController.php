<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class HikeController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /hikes
    * Displays an reverse-chronologically ordered list of a logged in user's hikes
    */
    public function getIndex() {
        $hikes = \App\Hike::where('user_id',\Auth::id())->with('peaks')->orderBy('date_hiked','DESC')->get();
        $user = \App\User::with('peaks')->find(\Auth::id());

        $welcome_messages = [
            'Hi there, ',
            'Ahoy, ',
            'Hiya, ',
            'Well hello there, ',
            'Howdy, ',
        ];

        $name = $user->first_name ? $user->first_name : $user->username;

        $random = rand(0, (count($welcome_messages) - 1));
        $welcome = $welcome_messages[$random] . $name. '.';

        foreach ($hikes as $hike) {
            $date_of_hike = Carbon::parse($hike->date_hiked);
            $hike->date_hiked = $date_of_hike->diffForHumans();
            if ($hike->public == 0) {
                $hike->private = ' private';
            }
        }
        
        $user_peaks = $user->peaks;
        $count = count($user_peaks);
        $progress = ($count / 48) * 100;

        return view('hikes.index')->with([
            'hikes' => $hikes,
            'welcome' => $welcome,
            'count' => $count,
            'progress' => $progress,
            ]);
    }

    /**
    * Responds to requests to GET /hikes/show/{id}
    */
    public function getShow($id) {
        $hike = \App\Hike::where('id',$id)->with('peaks','user')->first();

        if(is_null($hike)) {
            \Session::flash('flash_message','Hike not found.');
            if (\Auth::check()) {
                return redirect('/hikes');
            }
            else {
                return redirect('/');
            }
            
        }

        $date_of_hike = Carbon::parse($hike->date_hiked);
        $hike->date_hiked = $date_of_hike->diffForHumans();
        return view('hikes.show')->with('hike', $hike);
    }


    /**
     * Responds to requests to GET /hikes/log
     */
    public function getLog() {
        $peakModel = new \App\Peak();
        $peak_list = $peakModel->getPeakList();
        return view('hikes.log')->with('peak_list',$peak_list);
    }

    /**
     * Responds to requests to POST /hikes/log
     */
    public function postLog(Request $request) {
        $this->validate($request, [
            'mileage' => 'numeric',
            'peaks' => 'required',
            'date_hiked' => 'required|date|before:tomorrow'
        ]);

        $hike = new \App\Hike();
        $hike->date_hiked = $request->date_hiked;
        $hike->public = ($request->public == 'on' ? true : false);
        $hike->user_id = \Auth::id();

        // optional fields
        $hike->mileage = ($request->mileage ? $request->mileage : '');
        $hike->rating = ($request->rating ? $request->rating : '');
        $hike->notes = ($request->notes ? $request->notes : '');
        
        $hike->save();

        // add the peaks
        if($request->peaks) {
            $peaks = $request->peaks;
        }
        else {
            $peaks = [];
        }

        $user = \App\User::find(\Auth::id());

        $hike->peaks()->sync($peaks);
        $user->peaks()->sync($peaks,false);

        \Session::flash('flash_message','Your hike was logged!');
        
        return redirect('/hikes');
    }

    /**
     * Responds to requests to GET /hikes/edit/{id}
     */
    public function getEdit($id = null) {

        $hike = \App\Hike::with('peaks')->find($id);
        if(is_null($hike)) {
            \Session::flash('flash_message','Hike not found.');
            return redirect('/hikes');
        }

        // get peak list
        $peakModel = new \App\Peak();
        $peak_list = $peakModel->getPeakList();
        
        // Create a simple array of just the peaks associated with this hike;
        // will be used in the view to decide which peaks should be checked off
        
        $peaks_for_this_hike = [];
        foreach($hike->peaks as $peak) {
            $peaks_for_this_hike[] .= $peak->id;
        }

        return view('hikes.edit')
            ->with([
                'hike' => $hike,
                'peak_list' => $peak_list,
                'peaks_for_this_hike' => $peaks_for_this_hike,
            ]);

    }

    /**
     * Responds to requests to POST /hikes/edit
     */
    public function postEdit(Request $request) {

        $this->validate($request, [
            'mileage' => 'numeric',
            'peaks' => 'required',
            'date_hiked' => 'required|date|before:tomorrow'
        ]);

        $hike = \App\Hike::find($request->id);

        $hike->date_hiked = $request->date_hiked;
        $hike->public = ($request->public == 'on' ? true : false);
        $hike->user_id = \Auth::id();

        // optional fields
        $hike->mileage = ($request->mileage ? $request->mileage : '');
        $hike->rating = ($request->rating ? $request->rating : '');
        $hike->notes = ($request->notes ? $request->notes : '');
        
        $hike->save();

        // add the peaks
        if($request->peaks) {
            $peaks = $request->peaks;
        }
        else {
            $peaks = [];
        }

        $hike->peaks()->sync($peaks);

        \Session::flash('flash_message','Your hike was updated.');
        
        return redirect('/hikes');

    }

    /**
     * Responds to requests to GET /hikes/confirm-delete/{id}
     */
    public function getConfirmDelete($id) {

        $hike = \App\Hike::find($id);

        if(is_null($hike)) {
            \Session::flash('flash_message','Hike not found.');
            return redirect('/hikes');
        }

        $date_of_hike = Carbon::parse($hike->date_hiked);
        $hike->date_hiked = $date_of_hike->diffForHumans();

        return view('hikes.delete')->with('hike', $hike);
    }


    /**
     * Responds to requests to GET /hikes/delete/{id}
     */
    public function getDoDelete($id) {

        # Get the hike to be deleted
        $hike = \App\Hike::find($id);

        if(is_null($hike)) {
            \Session::flash('flash_message','Hike not found.');
            return redirect('/hikes');
        }

        # First remove any peaks associated with this hike
        if($hike->peaks()) {
            $hike->peaks()->detach();
        }

        # Then delete the hike
        $hike->delete();

        # Done
        \Session::flash('flash_message','Your hike was deleted.');
        return redirect('/hikes');

    }

}