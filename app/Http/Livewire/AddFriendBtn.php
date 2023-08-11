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
        if ($this->content != 'Sent!'){ //Already sent friend request
            $this->content = 'Sent!';
            Friends::addFriend($this->userid);
            Notifications::newNotification('New friend request from ' . User::find(Auth::id())->username, Auth::id(), $this->userid, route('profile', Auth::id()));
            session()->flash('message', 'Friend Request Successfully Sent!');
        }else{ //Cancel request if we press btn again
            Friends::deleteFriend(Auth::id(), $this->userid);
            session()->flash('message', 'Friend Request has been cancelled');
            $this->content = 'Add Friend';
        }
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
