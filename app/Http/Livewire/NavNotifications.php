<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;


class NavNotifications extends Component
{
    public $count;
    public function render()
    {
        $notifications = Notifications::where('to', Auth::id())
            ->where('status', 1)
            ->orderby('created_at', 'DESC')
            ->count();
        $this->count = $notifications;

        return view('livewire.nav-notifications');
    }

    public function deleteAndRedirect($link, $id)
    {
        Notifications::deleteNotification($id);

        return redirect()->to($link);

    }

    public function deleteAllUserNotifications()
    {
        $notifications = Notifications::where('to', auth()->id())
            ->get();
        $notifications->each->delete();
    }


}
