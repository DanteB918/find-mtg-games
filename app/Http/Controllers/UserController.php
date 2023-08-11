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

    public function search(): view 
    {
        return view('search');
    }
    /**
    *   Edit a User's info.
    *   @param array $fields = POST fields.
    */
    public static function editProfile(Request $request)
    {
        $fields = $request->all();
        try{
            $user = User::where('id', Auth::id())->first();

            if (isset($fields['profile_pic'])){
                $image_name = User::uploadProfilePic(request('profile_pic'));
                $user->profile_pic = $image_name;
            }
            
            $user->username = $fields['username'];
            $user->first_name = $fields['first_name'];
            $user->last_name = $fields['last_name'];
            $user->email = $fields['email'];
            $user->state = $fields['state'];
            $user->country = $fields['country'];
            $user->update();
            $user->refresh();

            return redirect('/profile/' . Auth::id());

        } catch (\Exception $e){
            //$e->getMessage()
            abort(403, 'Unauthorized Action');
            return false;
        }
    }
    public function friendsList(): View
    {
        return view('users.friendlist');
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
}
