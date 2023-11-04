<?php

namespace App\Http\Controllers;

use Ably\AblyRest;
use App\Models\Friends;
use App\Models\User;

class LiveChatController extends Controller
{
    protected AblyRest $api;

    protected $channel;

    public function __construct(AblyRest $api, $channel)
    {
        $this->api = new AblyRest(env('ABLY_KEY'));
        $this->channel = $this->api->channel('test');
    }

    public function chat($personOne, $personTwo)
    {
        User::findOrFail($personOne)
            ->with('friends', function($query) use ($personTwo){
                $query->where('friend_id', $personTwo)
                    ->orWhere('user_id', $personTwo);
            });

        return view('livechat');
    }

    public function postMessage($message)
    {
        //@todo, set this up some more after sorting out friend stuff.
        $this->channel->publish(auth()->user()->username, $message);
    }
}
