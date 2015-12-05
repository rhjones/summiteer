<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HikeController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /hikes
    */
    public function getIndex() {
        $hikes = \App\Hike::where('user_id','=',\Auth::id())->with('peaks')->orderBy('date_hiked','DESC')->get();

        foreach ($hikes as $hike) {
            $today = date_create();
            $date_of_hike = date_create_from_format('Y-m-d', $hike->date_hiked);
            $diff = date_diff($date_of_hike, $today);
            if ($diff->d <  1) {
                $hike->date_hiked = $diff->format('%h hours');
            }
            else if ($diff->d === 1) {
                $hike->date_hiked = '1 day';
            }
            else if ($diff->m < 1) {
                $hike->date_hiked = $diff->format('%d days');
            }
            else if ($diff->m === 1) {
                $hike->date_hiked = $diff->format ('1 month');
            }
            else if ($diff->y < 1) {
                $hike->date_hiked = $diff->format ('%m months');
            }
            else if ($diff->y === 1) {
                $hike->date_hiked = $diff->format ('1 year');
            }
            else {
                $hike->date_hiked = $diff->format ('%y years');
            }
            
        }
        return view('hikes.index')->with('hikes', $hikes);
    }

    /**
    * Responds to requests to GET /hikes/show/{id}
    */
    public function getShow($id) {
        return view('hikes.show')->with('id', $id);
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
        $hike->mileage = ($request->mileage ? $request->mileage : '');
        $hike->rating = ($request->rating ? $request->rating : '');
        $hike->notes = ($request->notes ? $request->notes : '');
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
        
        return redirect('/hikes');
    }

    /**
     * Responds to requests to GET /hikes/edit/{id}
     */
    public function getEdit($id = null) {
        return view('hikes.edit')->with('id', $id);

        // $hike = \App\Hike::with('peaks')->find($id);
        // if(is_null($hike)) {
        //     \Session::flash('flash_message','Hike not found.');
        //     return redirect('\hikes');
        // }
        // # Get all the possible authors so we can build the authors dropdown in the view
        // $authorModel = new \App\Author();
        // $authors_for_dropdown = $authorModel->getAuthorsForDropdown();
        // # Get all the possible tags so we can include them with checkboxes in the view
        // $tagModel = new \App\Tag();
        // $tags_for_checkbox = $tagModel->getTagsForCheckboxes();
        
        // Create a simple array of just the tag names for tags associated with this book;
        // will be used in the view to decide which tags should be checked off
        
        // $tags_for_this_book = [];
        // foreach($book->tags as $tag) {
        //     $tags_for_this_book[] = $tag->name;
        // }
        // return view('books.edit')
        //     ->with([
        //         'book' => $book,
        //         'authors_for_dropdown' => $authors_for_dropdown,
        //         'tags_for_checkbox' => $tags_for_checkbox,
        //         'tags_for_this_book' => $tags_for_this_book,
        //     ]);
    
    }

    /**
     * Responds to requests to POST /hikes/edit/{id}
     */
    public function postEdit() {
        return 'Process form to edit hike';
    }

    /**
     * 
     */
    public function getConfirmDelete($id) {
        return view('hikes.delete')->with('id', $id);
    }

    /**
     * 
     */
    public function getDoDelete() {
        return 'Delete hike';
    }

}