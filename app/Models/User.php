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
    *   Edit a User's info.
    *   @param array $fields = POST fields.
    */
    public static function editProfile($fields)
    {
        $user = User::where('id', Auth::id())->first();
        $user->username = $fields['username'];
        $user->first_name = $fields['first_name'];
        $user->last_name = $fields['last_name'];
        $user->email = $fields['email'];
        $user->state = $fields['state'];
        $user->country = $fields['country'];
        $user->update();
        $user->refresh();
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
}
