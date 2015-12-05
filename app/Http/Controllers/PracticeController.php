<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PracticeController extends Controller {
    
    function getExample1() {
        $carbondate = Carbon::now()->toRfc2822String();

        dump($carbondate);
    }
		
}