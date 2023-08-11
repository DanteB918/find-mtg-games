<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Type\VoidType;

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
        $user_id = Auth::id();
        
        $friends = Friends::where(function ($query) use ($user_id) {
            $query->where('user_id', $user_id)->where('status', 1);
        })->orWhere(function ($query) use ($user_id) {
            $query->where('friend_id', $user_id)->where('status', 1);
        })->get();

        $friend_list = [];
        foreach ($friends as $friend){ //find all ID's now other than users.
            if ($friend->user_id != Auth::id()){
                $friend_list[] = $friend->user_id;
            }
            if ($friend->friend_id != Auth::id()){
                $friend_list[] = $friend->friend_id;
            }
        }
        //now that all  users are appended to list, let's get all of their User objects.
        $final_list = [];
        foreach ($friend_list as $friend){
            $final_list[] = User::find($friend);
        }

        return $final_list;
    }
    public static function addFriend(int $friend_id)
    {
        $all_fields = array('status' => 0, 'user_id' => Auth::id(), 'friend_id' => $friend_id); //Appending required data.
        $newFriend = Friends::create($all_fields);
        $newFriend->refresh();
        return $newFriend;
    }
    public static function checkIfPending($user_id, $friend_id): bool
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

    public static function checkIfFriends($user_id, $friend_id): bool
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
    public static function deleteFriend($user_id, $friend_id): Void
    {
        $friend = Friends::where(function ($query) use ($user_id, $friend_id) {
            $query->where('user_id', $user_id)->where('friend_id', $friend_id)->where('status', 0);
        })->orWhere(function ($query) use ($user_id, $friend_id) {
            $query->where('friend_id', $user_id)->where('user_id', $friend_id)->where('status', 0);
        })->first();
        try{
            $friend->delete();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
    public static function getAllFriendRequests()
    {
        $user_id = Auth::id();
        $requests = Friends::where(function ($query) use ($user_id) {
            $query->where('user_id', $user_id)->where('status', 0);
        })->orWhere(function ($query) use ($user_id) {
            $query->where('friend_id', $user_id)->where('status', 0);
        })->get();

        return $requests;
    }
}
