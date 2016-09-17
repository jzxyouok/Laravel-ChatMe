<?php

namespace App\Http\Controllers;
use App\User;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * HomeController
 */
class SearchController extends Controller{

    public function getResults(Request $request){
        $query = $request->input('query');

        if(!$query){
            return redirect('home');
        }

        $users = User::where(DB::raw("CONCAT(firstname, ' ', 'lastname')"), 'LIKE', "%{$query}%")
                            ->orWhere('username', 'LIKE', "%{$query}%")
                            ->get();

        return view('search.results')->with('users', $users);


    }
}



?>
