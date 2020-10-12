const newKrakenForm = document.querySelector('#new-kraken-form');
const krakenNameInput = document.querySelector('#kraken-name');
const krakenAgeInput = document.querySelector('#kraken-age');
const krakenHeightInput = document.querySelector('#kraken-height');
const krakenWeightInput = document.querySelector('#kraken-weight');

const responseDiv = document.querySelector('#response-div');

newKrakenForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const data = {
        "name": krakenNameInput.value,
        "age": krakenAgeInput.value,
        "height": krakenHeightInput.value,
        "weight": krakenWeightInput.value
    };

    fetch('/kraken/create', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "Application/json"
        }
    })
    .then(response => {
        return response.json();
    })
    .then(response => {
        if (response.errors) {
            responseDiv.innerHTML = response.errorMessage;
            // TODO gestion des erreurs
        }
        else {
            // A modifier pour redirection vers la page de gestion d'un kraken
            responseDiv.innerHTML = response.message;
        }
    })
});