<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;

class UserController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
     * Responds to requests to GET /users/edit/{username}
     */
    public function getEdit() {

        $user = \Auth::user();

        if(is_null($user)) {
            \Session::flash('flash_message','User not found.');
            return redirect('/');
        }

        return view('user.edit')->with('user', $user);

    }

    public function postEdit(Request $request) {

        $this->validate($request, [
            'username' => 'required|max:255',
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'required|email|max:255',
            'current_password' => 'required',
            'password' => 'confirmed|min:6',
        ]);

        if(Hash::check($request->current_password, Auth::user()->password)) {

            $user = Auth::user();

            if($user->username !== $request->username) {
                $this->validate($request, [
                    'username' => 'unique:users',
                ]);

                $user->username = $request->username;
            }

            if($user->email !== $request->email) {
                $this->validate($request, [
                    'email' => 'unique:users',
                ]);

                $user->email = $request->email;
            }

            // optional fields
            $user->first_name = ($request->first_name ? $request->first_name : '');
            $user->last_name = ($request->last_name ? $request->last_name : '');
            $user->password = ($request->password ? bcrypt($request->password) : $user->password);
            
            $user->save();

            \Session::flash('flash_message','Your account was updated.');
            
            return redirect('/hikes');
        }
        else {

            $username = Auth::user()->username;
            \Session::flash('flash_message','Your current password does not match the password in our database.');
            return redirect('/user/edit/'.$username);
        }

        

    }

    /**
    * Responds to requests to GET /user/confirm-delete
    */
    public function getConfirmDelete() {
        $user = Auth::user();

        if(is_null($user)) {
            \Session::flash('flash_message','User not found.');
            return redirect('/');
        }

        return view('user.delete')->with('user', $user);
    }

    /**
    * Responds to requests to GET /user/delete
    */
    public function getDoDelete() {
        $user = Auth::user();

        if(is_null($user)) {
            \Session::flash('flash_message','User not found.');
            return redirect('/');
        }

        // Remove peaks associated with user
        if ($user->peaks()) {
            $user->peaks()->detach();
        }

        # First remove any hikes associated with this user
        if($user->hikes()) {
            foreach($user->hikes as $hike) {
                if($hike->peaks()) {
                    $hike->peaks()->detach();
                }
                $hike->delete();
            }
        }

        # Then delete the user
        $user->delete();

        # Done
        \Session::flash('flash_message','Your account was deleted.');
        return redirect('/');
    }


}