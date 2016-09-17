<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;


/**
 * AuthController
 */
class AuthController extends Controller{

    public function getSignup(){
        return view('auth.signup');
    }

    public function postSignup(Request $request){

        $this->validate($request, array(
            'email' =>  'required|unique:users|email|max:255',
            'username' =>  'required|unique:users|alpha_dash|max:20',
            'password' =>  'required|min:6',
        ));

        User::create(array(
            'email'     =>  $request->input('email'),
            'username'  =>  $request->input('username'),
            'password'  =>  bcrypt($request->input('password')),
        ));


        return redirect('home')->with('info', 'Your account has been created and you can sign in now.');

    }



    public function getSignin(){
        return view('auth.signin');
    }

    public function postSignin(Request $request){

        $this->validate($request, array(
            'email' =>  'required',
            'password'  =>  'required',
        ));


        if(! Auth::attempt( $request->only( array('email', 'password'), $request->has('remember') ))){
            return redirect()->back()->with('info', 'Invalid Email or Password');
        }

        return redirect('home')->with('info', 'Welcome');

    }


    public function getSignout(){
        Auth::logout();

        return redirect('home')->with('info', 'Come back Again.');
    }


}



?>
