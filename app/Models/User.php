<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



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
                //$image_name = $image->getClientOriginalName();
                $image_name =  strval(Auth::id()) . '.jpg';
                $image->move(public_path('images/profile_pics'), $image_name);
                return $image_name;
            }

        }catch (\Exception $e){
            abort(403, $e->getMessage());
        }
    }
    /**
     * Lists out all users.
     */
    public static function allUserOnlineStatus()
    {
            $users = User::all();
            foreach ($users as $user) {
                $isOnline = DB::table('sessions')->where('user_id', $user->id)->value('user_id');
                if ($isOnline)
                    echo $user->username . " is online. <br>";
                else
                    echo $user->username . " is offline <br>";
            }
    }
    /**
     * @return int # of users
     */
    public static function howManyUsers(): int
    {
        return count(User::all());
    }
    /**
     * Check current sessions on site to see if a user is online or offline.
     */
    public static function currentUserOnlineStatus($id)
    {
        //Checking current sessions for user online or offline.
        $isOnline = DB::table('sessions')->where('user_id', $id)->value('user_id');
        if ($isOnline){
            echo '<span style="color: green;">&#9679;</span> Online';
        }else{
            echo '<span style="color: red;">&#9679;</span> Offline';
        }
    }

}
