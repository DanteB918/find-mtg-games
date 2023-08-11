<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notifications;
use App\Models\User;
use App\Models\Friends;
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
        Friends::addFriend($this->userid);
        Notifications::newNotification('New friend request from ' . User::find(Auth::id())->username, Auth::id(), $this->userid, route('profile', Auth::id()));
        session()->flash('message', 'Friend Request Successfully Sent!');
    }
    public function render()
    {
        if (Friends::checkIfPending(Auth::id(), $this->userid)){
            $this->content = 'Sent!';
        }

        return view('livewire.add-friend-btn');
    }
    public function deleteFlash()
    {
        session()->forget('message');
    }
}
