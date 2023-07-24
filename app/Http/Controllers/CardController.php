<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

class CardController extends Controller
{
    public function cardLookup(): View
    {
        return view('card-lookup');
    }
    public function deckBuilder(): View
    {
        return view('deck-builder');
    }
}
