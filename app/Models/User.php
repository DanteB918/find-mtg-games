<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'country',
        'profile_pic',
        'state'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
    *   Upload profile pics, should return image name.
    *   @param $image 
    */
    public static function uploadProfilePic($image)
    {
        try{
            if ($image->isFile()){
                $image_name = $image->getClientOriginalName();
                $image->move(public_path('images/profile_pics'), $image_name);
                return $image_name;
            }
            
        }catch (\Exception $e){
            abort(403, $e->getMessage());
        }
    }
    /**
    *   Finding User by ID
    *   @param int $id = User ID.
    *   @return User $user
    */
    public static function findUser(int $id)
    {
        $user = User::where('id', $id)->first();
        $user->refresh();
        return $user;
    }
    public static function showAllUsersInArray(array $ids){ // Takes array of ID's and returns the users with those ids.
        $x = [];
        foreach($ids as $id){
            $the_user = User::where('id', $id)->first();
            array_push($x, $the_user);
        }
        return $x;
    }
    public static function returnUsername(int $user_id)
    {
        $user = User::where('id', $user_id)->first();
        return $user->username;
    }
}
