<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;


class Search extends Component
{
    public $placeholder = 'Search';
    public $param = NULL;
    public $results = NULL;

    public function render()
    {
        if ( $_GET )
        {
            $this->param = $_GET['user'];
            $this->searchUsers();
        }
        return view('livewire.search');
    }
    public function searchUsers()
    {
        $this->results = User::where('username', $this->param)->get();
    }
    public function redirectToSearch()
    {
        return redirect()->to('?user=' . $this->param );
    }
}
