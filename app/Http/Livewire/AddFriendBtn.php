<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AddFriendBtn extends Component
{
    public $content = 'Add Friend';
    public $userid;
    public function mount($user)
    {
        $this->userid = $user->id;
    }

    public function addFriend()
    {
        $this->content = 'Sent!';
        session()->flash('message', 'Friend Request Successfully Sent!');
        Notifications::newNotification('New friend request from ' . User::find(Auth::id())->username, Auth::id(), $this->userid, route('profile', Auth::id()));
        //session()->forget('message');
    }
    public function render()
    {
        return view('livewire.add-friend-btn');
    }
}
