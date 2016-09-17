<?php

namespace App\Http\Controllers;
use Auth;
use App\Status;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * HomeController
 */
class HomeController extends Controller{

    public function index(){
        #return the view resource/home.blade.php
        if(Auth::check()){
            $statuses =
				Status::notReply()
					->where(
						function($query) {
							return $query->where('userID', Auth::user()->id)
								->orWhereIn('userID', Auth::user()->friends()->lists('id'));
						})
				->orderBy('created_at', 'desc')
				->paginate(4);


            return view('timeline.index')->with('statuses', $statuses);
        }

        return view('home');
    }
}



?>
