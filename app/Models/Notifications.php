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
     * Function that displays the list of notifications.
     */
    public static function showUserNotifications(): Object
    {
        $notifications = Notifications::where('to', Auth::id())
        ->where('status', 1)
        ->orderby('created_at', 'DESC')
        ->get();

        return $notifications;

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
