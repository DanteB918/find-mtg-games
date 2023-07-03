<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * find profile by ID and display on front-end
     * @param int $id = id of user
     */
    public function findProfile(int $id) 
    {
        $user = DB::table('users')->find($id);
        if( $user ){
            return view('users.profile', compact('user'));
        }else{
            echo 'user not found';
        }
    }

    /**
    *   Logic for Editting user data
    *   @param int $id = id of given user in URL.
    */
    public function EditProfileView(int $id): View //GET method
    {
        if (Auth::id() === $id){ //if current user's id matches url id.
            $user = DB::table('users')->find($id);
            //$user = User::where('id', $id);

            return view('users.edit-profile', compact('user'));
        }else{
            return view('home');
        }
    }
    public function EditProfile(Request $request) //POST Method
    {
        User::editProfile($request->all());
        return redirect('/profile/' . Auth::id());
    }
}
