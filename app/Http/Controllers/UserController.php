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
}
