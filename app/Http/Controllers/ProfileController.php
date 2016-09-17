<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * HomeController
 */
class ProfileController extends Controller{



    public function getProfile($username){

        $user = User::where('username', $username)->first();
        if(!$user){
            abort(404);
        }

        $statuses = $user->statuses()->notReply()->get();

        return view('profile.index')
                ->with('user', $user)
                ->with('statuses', $statuses)
                ->with('authUserIsFriend', Auth::user()->isFriendsWith($user));
    }

    public function getEdit(){
        return view('profile.edit');
    }

    public function postEdit(Request $request){

        $this->validate($request, array(
            'firstname' =>  'alpha|max:50',
            'lastname'  =>  'alpha|max:50',
            'email'  =>  'required|email',
            'location'  =>  'max:100',
        ));


        Auth::user()->update(array(
            'firstname' =>  $request->input('firstname'),
            'lastname' =>  $request->input('lastname'),
            'email' =>  $request->input('email'),
            'location' =>  $request->input('location'),
        ));

        return redirect('profile/edit')
                    ->with('info', 'Your Profile has been updated.');
    }
}



?>
