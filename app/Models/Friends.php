<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Friends extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'friend_id',
        'status'
    ];
    protected $table = 'friends';

    public static function getAllUsersFriends()
    {
        //work in progress
        return Friends::all();
    }
    public static function addFriend(int $friend_id)
    {
        $all_fields = array('status' => 0, 'user_id' => Auth::id(), 'friend_id' => $friend_id); //Appending required data.
        $newFriend = Friends::create($all_fields);
        $newFriend->refresh();
        return $newFriend;
    }
    public static function checkIfPending($user_id, $friend_id)
    {
        $areFriends = Friends::where(function ($query) use ($user_id, $friend_id) {
            $query->where('user_id', $user_id)->where('friend_id', $friend_id)->where('status', 0);
        })->orWhere(function ($query) use ($user_id, $friend_id) {
            $query->where('user_id', $friend_id)->where('friend_id', $user_id)->where('status', 0);
        })->exists();
        
        if ($areFriends) {
            return 1; // Yes the request is pending.
        } else {
            return 0; // No, not pending.
        }
    }

    public static function checkIfFriends($user_id, $friend_id)
    {
        $areFriends = Friends::where(function ($query) use ($user_id, $friend_id) {
            $query->where('user_id', $user_id)->where('friend_id', $friend_id)->where('status', 1);
        })->orWhere(function ($query) use ($user_id, $friend_id) {
            $query->where('user_id', $friend_id)->where('friend_id', $user_id)->where('status', 1);
        })->exists();
        
        if ($areFriends) {
            return 1; // Yes friends.
        } else {
            return 0; // no, not friends
        }
    }
}
