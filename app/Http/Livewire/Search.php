<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

/**
 * To use this component, please add the "searching_for" param when calling it in a blade.
 * For example: <livewire:search :searching_for="'user'" /> 
 * where $searching_for = 'user'
 * 
 * Then we must add support in the blade and functions here.
 */
class Search extends Component
{
    public $placeholder = 'Search';
    public $param = NULL;
    public $results = NULL;
    public $searching_for;

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
        $this->results = User::where('username', 'like', '%' . $this->param . '%')->get();
    }
    public function redirectToSearch()
    {
        return redirect()->to('?user=' . $this->param );
    }
}
