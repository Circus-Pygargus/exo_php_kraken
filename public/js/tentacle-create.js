// the form
const tentacleCreateForm = document.querySelector('#tentacle-create-form');
const tentacleNameInput = document.querySelector('#tentacle-name');
const tentacleLifePointsInput = document.querySelector('#tentacle-life-points');
const tentacleForceInput = document.querySelector('#tentacle-force');
const tentacleDexterityInput = document.querySelector('#tentacle-dexterity');
const tentacleConstitutionInput = document.querySelector('#tentacle-constitution');

// places to display infos
const tentacleInfosDiv = document.querySelector('#tentacles-infos');


tentacleCreateForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const data = {
        "krakenId": tentacleCreateForm.dataset.krakenId,
        "name": tentacleNameInput.value,
        "lifePoints": tentacleLifePointsInput.value,
        "force": tentacleForceInput.value,
        "dexterity": tentacleDexterityInput.value,
        "constitution": tentacleDexterityInput.value
    };

    fetch('/tentacle', {
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
            // todo gérer les erreurs
        }
        else {
            tentacleInfosDiv.innerHTML = response.tentacleHtml;
            cleanAndHideForm();
            unenlightBtns();
            manageBtnsActivation();
        }
    })
});


