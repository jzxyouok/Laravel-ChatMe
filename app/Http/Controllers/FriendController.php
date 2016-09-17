<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * FriendController
 */
class FriendController extends Controller{

    public function getIndex(){

        $friends = Auth::user()->friends();
        $friendRequests = Auth::user()->friendRequests();

        return view('friends.index')
                ->with('friends', $friends)
                ->with('friendRequests', $friendRequests);
    }


    public function getAdd($username){
        $user = User::where('username', $username)->first();

        #if user exist
        if(!$user){
            return redirect('home')->with('info', 'That user could not be found');
        }



        if(Auth::user()->id === $user->id){
            return redirect('home');
        }


        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){
            return redirect()
                    ->route('profile.index', ['username' =>    $user->username])
                    ->with('info', 'Friend Request already pending.');
        }

        if(Auth::user()->isFriendsWith($user)){
            return redirect()
                ->route('profile.index', ['username' =>    $user->username])
                ->with('info', 'You are already friends.');
        }

        Auth::user()->addFriend($user);
        return redirect()
            ->route('profile.index', ['username'    =>  $username])
            ->with('info', 'Friend Request Send.');

    }




    public function getAccept($username){

        $user = User::where('username', $username)->first();

        #if user exist
        if(!$user){
            return redirect('home')->with('info', 'That user could not be found');
        }

        if(!Auth::user()->hasFriendRequestReceived($user)){
            return redirect('home');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()
            ->route('profile.index', ['username'    =>  $username])
            ->with('info', 'Friend Request Accepted.');

    }
}



?>
