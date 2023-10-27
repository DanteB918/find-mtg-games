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
    public static function showUserNotifications()
    {
        $notifications = Notifications::with('user')
        ->where('status', 1)
        ->orderby('created_at', 'DESC')
        ->get();

        return $notifications;

    }
    public function user()
    {
        return $this->belongsTo(User::class, 'to', 'id');
    }
    public static function newNotification($message, $from, $to, $link)
    {
        $the_notification = [
            'status' => 1, 
            'content' => $message, 
            'from' => $from, 
            'to' => $to,
            'link' => $link 
        ]; //Appending required data.

        Notifications::create($the_notification);
    }
    public static function deleteNotification(int $id)
    {
        $notification = Notifications::find($id);
        $notification->delete();
    }
}
