const watchPowerRemoveForm = () => {
    // the form
    const powerRemoveForm = document.querySelector('#power-remove-form');
    const powerRemoveSelect = document.querySelector('#power-remove-select');


    // places to display things
    const powerInfosDiv = document.querySelector('#powers-infos');
    // already declared in power-add.js
    // const powerAddDiv = document.querySelector('#power-add-div');
    // const powerRemoveDiv = document.querySelector('#power-remove-div');



    powerRemoveForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const data = {
            "krakenId": powerRemoveForm.dataset.krakenId,
            "powerId": powerRemoveSelect.value
        };

        fetch('/power/remove', {
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
            if (response.response !== 'ok') {
                // todo gérer les erreurs
            }
            else {
                powerInfosDiv.innerHTML = response.powersHtml;
                powerAddDiv.innerHTML = response.addablePowersHtml;
                powerRemoveDiv.innerHTML = response.removablePowersHtml;
                cleanAndHideForm();
                unenlightBtns();
                manageBtnsActivation();
                watchPowerAddForm();
                watchPowerRemoveForm();
            }
        })
    });
};


watchPowerRemoveForm();