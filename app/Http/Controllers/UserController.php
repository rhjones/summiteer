<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
     * Responds to requests to GET /user/{username}
     */
    public function getIndex($username = null) {
        return 'Display user profile for '.$username;
    }

    /**
     * Responds to requests to GET /user/create
     */
    public function getCreate() {
        return 'Form to create a new user';
    }

    /**
     * Responds to requests to POST /user/create
     */
    public function postCreate() {
        return 'Process adding new user';
    }

    /**
     * Responds to requests to GET /user/edit/{username}
     */
    public function getEdit() {
        return 'Form to edit user';
    }

    /**
     * Responds to requests to POST /user/edit/{username}
     */
    public function postEdit() {
        return 'Process form to edit user';
    }

    /**
     * Responds to requests to POST /user/delete/{username}
     */
    public function postDelete() {
        return 'Delete user';
    }

}