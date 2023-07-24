@extends('layouts.app')

@section('content')
  <div class="container lookup">
    <h1>MTG Card Lookup</h1>
    <input type="text" id="cardNameInput" placeholder="Enter card name">
    <button onclick="searchCard()">Search</button>
    <div id="cardData"></div>
  </div>
@endsection

<script>
    //Card Lookup JS

    function searchCard() {
    const cardNameInput = document.getElementById("cardNameInput");
    const cardName = cardNameInput.value;
  
    // Make sure the input is not empty
    if (!cardName) {
      alert("Please enter a card name!");
      return;
    }
  
    // Encode the card name to be used in the API URL
    const encodedCardName = encodeURIComponent(cardName);
  
    // Scryfall API URL for card search
    const apiUrl = `https://api.scryfall.com/cards/named?fuzzy=${encodedCardName}`;
  
    fetch(apiUrl)
      .then(response => response.json())
      .then(cardData => displayCardData(cardData))
      .catch(error => console.error("Error fetching card data:", error));
  }
  
  
  function displayCardData(cardData) {
    const cardDataDiv = document.getElementById("cardData");
    cardDataDiv.innerHTML = "";
  
    if (cardData.object === "error") {
      cardDataDiv.innerHTML = `<p>No card found. Please check the card name and try again.</p>`;
    } else {
      const cardImage = cardData.image_uris.normal;
      const cardName = cardData.name;
      const cardType = cardData.type_line;
      const cardSet = cardData.set_name;
      const cardRarity = cardData.rarity;
      const cardPrice = cardData.prices.usd || "N/A";
  
      const cardInfoHTML = `
        <img src="${cardImage}" alt="${cardName}" style="max-width: 100%; height: auto;" />
        <p><strong>Name:</strong> ${cardName}</p>
        <p><strong>Type:</strong> ${cardType}</p>
        <p><strong>Set:</strong> ${cardSet}</p>
        <p><strong>Rarity:</strong> ${cardRarity}</p>
        <p><strong>Price (USD):</strong> $${cardPrice}</p>
      `;
  
      cardDataDiv.innerHTML = cardInfoHTML;
    }
  }
</script>