<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function findProfile(String $id) // find profile by ID and display on front-end
    {
        $user = DB::table('users')->find($id);
        if( $user ){
            return view('profile', compact('user'));
        }else{
            echo 'user not found';
        }
    }

    /*
    *   Logic for Editting user data
    */
    public function EditProfileView(string $id): View //GET method
    {
        if (Auth::id() === intval($id)){ //if current user's id matches url id.
            $user = DB::table('users')->find($id);
            //$user = User::where('id', $id);

            return view('edit-profile', compact('user'));
        }else{
            return view('home');
        }
    }
    public function EditProfile(Request $request) //POST Method
    {
        /*$name = $request->input('name');
        $email = $request->input('email');
        $date = $request->input('date');
        $data=array('time'=>$time,"number_players"=>$number_players,"date"=>$date,"state"=>$state,"country"=>$country,"power_level"=>$power_level, "description"=>$description, "format"=>$format, "status"=>true);
        DB::table('games')->insert($data);*/
        User::editProfile($request->all());
        return view('game-form-submitted');
    }
}
