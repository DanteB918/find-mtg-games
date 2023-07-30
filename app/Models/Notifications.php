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
    /**
     * Display number of notifications.
     * @return int = # of notifications
     */
    public static function amountNotifications()
    {
        $notifications = Notifications::where('to', Auth::id())
        ->where('status', 1)
        ->orderby('created_at', 'DESC')
        ->get();
        
        return count($notifications);
    }
    /**
     * Function that displays the list of notifications.
     */
    public static function showUserNotifications()
    {
        $notifications = Notifications::where('to', Auth::id())
        ->where('status', 1)
        ->orderby('created_at', 'DESC')
        ->get();
        if (!$notifications->isEmpty()){
            foreach($notifications as $notification)
            {
                $notification->refresh();
                echo '<li class="notify-' . $notification->id . '" onClick="deleteNotify(' . $notification->id . ')"><a class="dropdown-item" href="' . $notification->link . '">'. $notification->content . '</a></li>'
                . ' <li><hr class="dropdown-divider"></li>';
            }
        }else{
            echo 'No new notifications.';
        }
    
    }
    public static function newNotification($message, $from, $to, $link)
    {
        $the_notification = array('status' => 1, 'content' => $message, 'from' => $from, 'to' => $to, 'link' => $link ); //Appending required data.
        Notifications::create($the_notification);
    }
    public static function deleteNotification(int $id)
    {
        $notification = Notifications::where('id', $id)->first();
        try{
            $notification->delete();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
