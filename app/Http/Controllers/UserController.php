<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /user/confirm-delete/{username}
    */
    public function getConfirmDelete($username = null) {
        $user = \App\User::where('username', $username)->first();

        return view('user.delete')->with(['user' => $user]);
    }

    /**
    * Responds to requests to GET /user/delete/{username}
    */
    public function getDoDelete($username = null) {
        # Get the user to be deleted
        $user = \App\User::where('username', $username)->first();

        if(is_null($user)) {
            \Session::flash('flash_message','User not found.');
            return redirect('/');
        }

        # First remove any hikes associated with this user
        if($user->hikes()) {
            foreach($user->hikes as $hike) {
                if($hike->peaks()) {
                    $hike->peaks()->detach();
                }
            }
            \App\Hike::where('user_id',$user->id)->delete();
        }

        # Then delete the user
        $user->delete();

        # Done
        \Session::flash('flash_message','Your account was deleted.');
        return redirect('/');
    }


}