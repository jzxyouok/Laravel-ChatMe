<?php

namespace App\Http\Controllers;
use DB;
use App\Like;
use Auth;
use App\User;
use App\Status;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * HomeController
 */
class StatusController extends Controller{

    public function postStatus(Request $request){

        $this->validate($request, array(
            'status' => 'required|max:1000',
        ));


        Auth::user()->statuses()->create(array(
            'body'  =>  $request->input('status'),
        ));

        return redirect('home')->with('info', 'Status Posted.');

    }



    public function postReply(Request $request, $statusID){

        $this->validate($request, array(
                    'reply-' . $statusID     =>  'required|max:1000',
                    ),
                    array(
                        'required'  =>  'The reply body is required.',
                    )
        );

        $status = Status::notReply()->find($statusID);

        if(! $status){
            return redirect('home');
        }

        if(! Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id){
            return redirect('home');
        }

        $reply = Status::create(array(
            'body'  =>  $request->input('reply-'. $statusID),
        ))->user()->associate(Auth::user());

        $status->replies()->save($reply);

        return redirect()->back();
    }


    public function getLike($statusID){
        $status = status::find($statusID);

        if(! $status){
            return redirect('home');
        }

        if(! Auth::user()->isFriendsWith($status->user)){
            return redirect('home');
        }

        if(Auth::user()->hasLikesStatus($status)){

            return redirect()->back();
        }

        $like = $status->likes()->create(array());

        Auth::user()->likes()->save($like);

        return redirect()->back();

    }

}



?>
