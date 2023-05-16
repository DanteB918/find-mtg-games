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
        return view('profile', compact('user'));
    }

    /*
    *   Logic for Editting user data
    */
    public function EditProfileView(string $id): View //GET method
    {
        if (Auth::id() === $id){
            $user = DB::table('users')->find($id);
            return view('edit-profile');
        }else{
            return view('home');
        }
    }
    public function EditProfile(Request $request) //POST Method
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $date = $request->input('date');
        $data=array('time'=>$time,"number_players"=>$number_players,"date"=>$date,"state"=>$state,"country"=>$country,"power_level"=>$power_level, "description"=>$description, "format"=>$format, "status"=>true);
        DB::table('games')->insert($data);
        return view('game-form-submitted');
    }
}
