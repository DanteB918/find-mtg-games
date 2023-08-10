<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;


class NavNotifications extends Component
{
    public function render()
    {
        return view('livewire.nav-notifications');
    }
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
    public function deleteAndRedirect($link, $id)
    {
        Notifications::deleteNotification($id);
        return redirect()->to($link);

    }


}
