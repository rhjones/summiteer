<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Home view
Route::get('/', 'HomeController@getIndex');

// Show login form
Route::get('/login', 'Auth\AuthController@getLogin');

// Process login form
Route::post('/login', 'Auth\AuthController@postLogin');

// Process logout
Route::get('/logout', 'Auth\AuthController@getLogout');

// Show registration form
Route::get('/register', 'Auth\AuthController@getRegister');

// Process registration form
Route::post('/register', 'Auth\AuthController@postRegister');

// routes for displaying peaks
Route::get('/peaks', 'PeakController@getIndex');

Route::get('/peaks/{id}', 'PeakController@showPeak');

Route::get('/hikes/show/{id}', 'HikeController@getShow');

Route::group(['middleware' => 'auth'], function() {
    Route::get('hikes', 'HikeController@getIndex');
    Route::get('/hikes/log', 'HikeController@getLog');
    Route::post('/hikes/log', 'HikeController@postLog');
    Route::get('/hikes/edit', 'HikeController@getEdit');
    Route::post('/hikes/edit', 'HikeController@postEdit');
    Route::get('/hikes/confirm-delete/{id}', 'HikeController@getConfirmDelete');
  //  Route::get('/hike/delete/{id}', 'HikeController@getDoDelete');    

});

if(App::environment('local')) {
	
	Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
};

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    //print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});

Route::get('/confirm-login-worked', function() {

    # You may access the authenticated user via the Auth facade
    $user = Auth::user();

    if($user) {
        echo 'You are logged in.';
        dump($user->toArray());
    } else {
        echo 'You are not logged in.';
    }

    return;

});