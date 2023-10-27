<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Games;
use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function deleteNotification(int $id)
    {
        Notifications::deleteNotification($id);
    }
}
