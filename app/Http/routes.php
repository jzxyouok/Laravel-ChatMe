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

/*
Route::get('/', function () {
    return view('welcome');
});
*/




Route::resource('/home', 'HomeController@index');

Route::resource('/', 'HomeController@index');


/**
*   ROUTE - ALERT
*/
Route::get('/alert', function(){
    return redirect('home')->with('info', 'Successfully Signup.');
});



/**
* Authentication
*/

Route::get('/signup', array(
    'uses'          =>  '\App\Http\Controllers\AuthController@getSignup',
    'as'            =>  'auth.signup',
    'middleware'    =>  ['guest'],
));


Route::post('/signup', array(
    'uses'          =>  '\App\Http\Controllers\AuthController@postSignup',
    'middleware'    =>  ['guest'],
));




/**
* SIGNIN
*/

Route::get('/signin', array(
    'uses'          =>  '\App\Http\Controllers\AuthController@getSignin',
    'as'            =>  'auth.signin',
    'middleware'    =>  ['guest'],
));


Route::post('/signin', array(
    'uses'          =>  '\App\Http\Controllers\AuthController@postSignin',
    'middleware'    =>  ['guest'],
));

Route::get('/signout', array(
    'uses'          =>  '\App\Http\Controllers\AuthController@getSignout',
    'as'            =>  'auth.signout'
));



/**
* SEARCH
*/

Route::get('/search', array(
    'uses'  =>  '\App\Http\Controllers\SearchController@getResults',
    'as'    =>  'search.results',
));


/**
* PROFILE
*/

Route::get('/user/{username}', array(
    'uses'  =>  '\App\Http\Controllers\ProfileController@getProfile',
    'as'    =>  'profile.index',
));



/**
* UPDATE PROFILE
*/

Route::get('/profile/edit', array(
    'uses'  =>  '\App\Http\Controllers\ProfileController@getEdit',
    'as'    =>  'profile.edit',
    'middleware'    =>  ['auth'],
));

Route::post('/profile/edit', array(
    'uses'  =>  '\App\Http\Controllers\ProfileController@postEdit',
    'as'    =>  'profile.edit',
    'middleware'    =>  ['auth'],
));


/**
* Friends
*/

Route::get('/friends', array(
    'uses'          =>  'FriendController@getIndex',
    'as'            =>  'friend.index',
    'middleware'    =>  ['auth'],
));

/**
* Friends
*/

Route::get('/friends/add/{username}', array(
    'uses'          =>  'FriendController@getAdd',
    'as'            =>  'friend.add',
    'middleware'    =>  ['auth'],
));


Route::get('/friends/accept/{username}', array(
    'uses'          =>  'FriendController@getAccept',
    'as'            =>  'friend.accept',
    'middleware'    =>  ['auth'],
));



/**
* STATU CONTROLLER
*/

Route::post('/status', array(
    'uses'          =>  'StatusController@postStatus',
    'as'            =>  'status.post',
    'middleware'    =>  ['auth'],
));

/**
* POSTING REPLY
*/

Route::post('/status/{statusID}/reply', array(
    'uses'          =>  'StatusController@postReply',
    'as'            =>  'status.reply',
    'middleware'    =>  ['auth'],
));


/**
* GET LIKE
*/

Route::get('/status/{statusID}/like', array(
    'uses'          =>  'StatusController@getLike',
    'as'            =>  'status.like',
    'middleware'    =>  ['auth'],
));
