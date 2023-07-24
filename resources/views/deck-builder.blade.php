@extends('layouts.app')

@section('content')
		<div class="deck-builder container">
            <h1>MTG Deck Builder</h1><br />
			<h2>Deck List</h2>
			<ul id="deck-list"></ul>
			<!--<h2>Add Card</h2>-->
			<form id="add-card-form">
				<input type="text" id="card-name" placeholder="Card Name">
				<input type="number" id="quantity" min="1" value="1">
				<button type="submit">Add to Deck</button>
			</form>
		</div>
@endsection

<script>
/*
*   Deck Builder JS
*/
document.addEventListener('DOMContentLoaded', () => {
    const deckList = document.getElementById('deck-list');
    const addCardForm = document.querySelector('#add-card-form');
    const cardNameInput = document.getElementById('card-name');
    const quantityInput = document.getElementById('quantity');

    // Load decks from LocalStorage on page load
    /*document.addEventListener('DOMContentLoaded', () => {
        loadDeck();
    });*/

    // Add card to the deck
    addCardForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const cardName = cardNameInput.value.trim();
        const quantity = parseInt(quantityInput.value);

        if (cardName !== '' && quantity > 0) {
            searchCard(cardName, quantity);
        }
    });

    // Load deck from LocalStorage
    function loadDeck() {
        const deck = JSON.parse(localStorage.getItem('mtgDeck')) || [];
        renderDeck(deck);
    }

    // Save deck to LocalStorage
    /*function saveDeck() {
        const deck = Array.from(deckList.children).map(item => {
            return {
                name: item.dataset.name,
                quantity: parseInt(item.dataset.quantity)
            };
        });
        localStorage.setItem('mtgDeck', JSON.stringify(deck));
    }*/

    // Add card to the deck
    function addToDeck(cardData, quantity) {
        const existingCard = deckList.querySelector(`li[data-name="${cardData.name}"]`);
        if (existingCard) {
            existingCard.dataset.quantity = parseInt(existingCard.dataset.quantity) + quantity;
            existingCard.querySelector('.card-info').textContent = `${existingCard.dataset.quantity}x ${cardData.name}`;
        } else {
            const cardItem = document.createElement('li');
            cardItem.dataset.name = cardData.name;
            cardItem.dataset.quantity = quantity;

            const cardImage = document.createElement('img');
            cardImage.src = cardData.image_uris.normal;
            cardImage.alt = cardData.name;
            cardImage.classList.add('card-image');

            const cardInfo = document.createElement('span');
            cardInfo.textContent = `${quantity}x ${cardData.name}`;
            cardInfo.classList.add('card-info');

            cardItem.appendChild(cardImage);
            cardItem.appendChild(cardInfo);

            deckList.appendChild(cardItem);
        }
    }

    // Search card using Scryfall API
    function searchCard(cardName, quantity) {
        fetch(`https://api.scryfall.com/cards/named?fuzzy=${encodeURIComponent(cardName)}`)
            .then(response => response.json())
            .then(cardData => {
                addToDeck(cardData, quantity);
                saveDeck();
                addCardForm.reset();
            })
            .catch(error => {
                console.error('Error fetching card data:', error);
            });
    }

    // Render the deck list
    function renderDeck(deck) {
        deckList.innerHTML = '';
        deck.forEach(card => {
            const cardItem = document.createElement('li');
            cardItem.dataset.name = card.name;
            cardItem.dataset.quantity = card.quantity;
            cardItem.textContent = `${card.quantity}x ${card.name}`;
            deckList.appendChild(cardItem);
        });
    }
});

</script>