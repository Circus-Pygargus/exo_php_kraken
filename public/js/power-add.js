const watchPowerAddForm = () => {
    // the form
    const powerAddForm = document.querySelector('#power-add-form');
    const powerAddSelect = document.querySelector('#power-add-select');

    const powerCancelAddBtn = document.querySelector('#power-add-close');


    // places to display things
    const powerInfosDiv = document.querySelector('#powers-infos');
    // already declared in display-manager.js
    // const powerAddDiv = document.querySelector('#power-add-div');
    // const powerRemoveDiv = document.querySelector('#power-remove-div');


    powerCancelAddBtn.addEventListener('click', () => {
        cleanAndHideForm();
        unenlightBtns();
    });


    powerAddForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const data = {
            "krakenId": powerAddForm.dataset.krakenId,
            "powerId": powerAddSelect.value
        };

        fetch('/power/add', {
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
                console.table(response)
                powerInfosDiv.innerHTML = response.powersHtml;
                powerAddDiv.innerHTML = response.addablePowersHtml;
                powerRemoveDiv.innerHTML = response.removablePowersHtml;
                cleanAndHideForm();
                unenlightBtns();
                manageBtnsActivation();
                watchPowerAddForm();
                // watchPowerRemoveForm();
            }
        })
    });
}

watchPowerAddForm();