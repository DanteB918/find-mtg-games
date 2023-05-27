<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Games;


class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'time', 
        'date', 
        'status', 
        'link',
        'content',
        'from',
        'to' ];
    protected $table = 'notifications';
    protected $casts = [
        'current_players' => 'array',
      ];
    
    public function getUsernames($user_id)
    {
        $user = User::where('id', $user_id)->first();
        return $user->username;
    }
    public static function showUserNotifications()
    {
        var_dump(Auth::id());
        $notifications = Notifications::all();

        foreach($notifications as $notification)
        {
            $notification->refresh();
            return '<li><a class="dropdown-item" href="#">'. $notification->content . ' from: ' . $notification->getUsernames($notification->from) . '</a></li>'
            . ' <li><hr class="dropdown-divider"></li>';
        }
    
    }
}
