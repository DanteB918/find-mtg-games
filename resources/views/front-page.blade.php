@extends('layouts.app')

@section('content')
<div class="container front">
    <h1 class="header-text">Welcome to MTG GatherHub: Your Gateway to Magic: The Gathering Adventures!</h1>
    Are you a passionate Magic: The Gathering player seeking thrilling duels and camaraderie with fellow enthusiasts? Look no further! MTG GatherHub is your ultimate web application, powered by Laravel PHP, designed to seamlessly connect you with like-minded players for epic games and memorable battles right in your neighborhood.
    <br /><br />
    <p><em><u>This app is also 100% free.</u></em></p>
    <h2 class="header-text">Discover Nearby Players and Games</h2>
    Our innovative platform brings together Magic players from all corners. With a few clicks, you can explore a map highlighting nearby players, upcoming events, and game gatherings. Find opponents for casual matches, or challenge yourself against seasoned pros – the choice is yours!
    <br /><br />

    <h3 class="header-text">Forge Friendships and Create Gaming Circles</h3>
    Connect with other MTG aficionados and forge lifelong friendships. Our robust friend invitation system enables you to send and accept friend requests, building a network of players who share your passion. Expand your social circle and keep the spirit of competition alive!
    <br /><br />

    <h4 class="header-text">Organize Games with Ease</h4>
    Planning a game night has never been simpler. Utilize our intuitive game organizer to schedule matches, invite friends, and set up events. Whether it's a friendly match or a heated tournament, MTG GatherHub ensures your gaming sessions are seamless and unforgettable.
    <br /><br />

    <h5 class="header-text">Dive into the World of Cards</h5>
    Access our comprehensive card database to explore the vast universe of Magic: The Gathering. Look up cards, view their stats, and stay up-to-date with the latest expansions. Knowledge is power, and we're here to empower your gameplay.
    <br /><br />

    <h6 class="header-text">Craft, Share, and Showcase Your Decks</h6>
    Deck building is an art, and MTG GatherHub provides you with the perfect canvas. Craft your ideal decklists using our user-friendly interface, draw inspiration from others, and share your creations with the community. Let your creativity shine and your strategies flourish.
    <br /><br />

    <b class="header-text">Join the MTG GatherHub Community</b>
    <br />
    Become a part of the thriving MTG GatherHub community. Share your triumphs, discuss strategies, and exchange insights with fellow players who understand your passion. Engage in lively discussions, share deck ideas, and celebrate the brilliance of Magic: The Gathering together.
    <br /><br />

    <b class="header-text">Embark on a Journey of Epic Battles and Lifelong Friendships</b>
    <br />

    MTG GatherHub is your gateway to a realm where cards come to life, tactics reign supreme, and friendships are forged through the heat of competition. Join us today and step into a world of Magic: The Gathering that's closer than ever before.
    <br /><br />

    <em class="header-text">Are you ready to embrace the Magic? <a href="{{ route('register') }}">Sign up for MTG GatherHub</a> and embark on a journey of epic battles and lifelong friendships!</em>
</div>
@endsection
@include('alert-bar')

