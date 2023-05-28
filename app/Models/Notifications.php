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
        'status', 
        'link',
        'content',
        'from',
        'to' ];
    protected $table = 'notifications';
    public static function showUserNotifications()
    {
        $notifications = Notifications::where('to', Auth::id())
        ->where('status', 1)
        ->orderby('created_at', 'DESC')
        ->get();
        if ($notifications){
            foreach($notifications as $notification)
            {
                $notification->refresh();
                echo '<li><a class="dropdown-item" href="#">'. $notification->content . '</a></li>'
                . ' <li><hr class="dropdown-divider"></li>';
            }
        }else{
            echo 'No Notifications at this time.';
        }
    
    }
    public static function newNotification($message, $from, $to)
    {
        $the_notification = array('status' => 1, 'content' => $message, 'from' => $from, 'to' => $to ); //Appending required data.
        Notifications::create($the_notification);
    }
}
