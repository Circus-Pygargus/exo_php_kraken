/* ############# VARIABLES ############# */
// buttons
const tentacleAddBtn = document.querySelector('#tentacle-add-btn');
const tentacleRemoveBtn = document.querySelector('#tentacle-remove-btn');
const powerAddBtn = document.querySelector('#power-add-btn');

const editBtns = [tentacleAddBtn, tentacleRemoveBtn, powerAddBtn];

// form containers
const tentacleCreateDiv = document.querySelector('#tentacle-create-div');
const tentacleRemoveDiv = document.querySelector('#tentacle-remove-div');
const powerAddDiv = document.querySelector('#power-add-div');
const powerRemoveDiv = document.querySelector('#power-remove-div');

const formContainers = [tentacleCreateDiv, tentacleRemoveDiv, powerAddDiv, powerRemoveDiv];



/* ############# EVENT LISTENERS ############# */
tentacleAddBtn.addEventListener('click', (e) => {
    manageDisplay(e.target, tentacleCreateDiv);
});


tentacleRemoveBtn.addEventListener('click', (e) => {
    manageDisplay(e.target, tentacleRemoveDiv);
});


powerAddBtn.addEventListener('click', (e) => {
    manageDisplay(e.target, powerAddDiv);
});



/* ############# FUNCTIONS ############# */

// manage buttons and form containers to display wanted form
const manageDisplay = (btn, container) => {
    unenlightBtns();
    cleanAndHideForm();
    enlightBtn(btn);
    displayForm(container);
};


// enlight clicked button
const enlightBtn = (btn) => {
    btn.classList.remove('btn-secondary');
    btn.classList.add('btn-success');
};


// unenlight buttons
const unenlightBtns = () => {
    editBtns.forEach(editBtn => {
        editBtn.classList.add('btn-secondary');
        editBtn.classList.remove('btn-success');
    });
};


// clean and hide displayed form
const cleanAndHideForm = () => {
    formContainers.forEach(container => {
        if (!container.classList.contains('d-none')) {
            const formControls = container.querySelectorAll('.form-control');
            formControls.forEach(formControl => {
                if (formControl.tagName === 'INPUT'){
                    // delete input inserted value
                    formControl.value = '';
                }
                else if (formControl.tagName === 'SELECT') {
                    // select default value (wich is "" by default)
                    formControl.selectedIndex = "0";
                }
            });
            // hide form
            container.classList.add('d-none');
        }
    });
};


// display requested form
const displayForm = (container) => {
    container.classList.remove('d-none');
};



// manage activation/deactivation of buttons according to kraken status
/* 
    RULES :
    Kraken can have from 0 to 8 tentacles
    Kraken can have 1 power without any tentacle, and then 1 power every 4 tentacles
        so maximum powers number is 3
*/
const manageBtnsActivation = () => {
    const tentaclesNb = document.querySelectorAll('.tentacle').length;
    const powersNb = document.querySelectorAll('.power').length;
    if (tentaclesNb === 0) {
        tentacleAddBtn.disabled = false;
        tentacleRemoveBtn.disabled = true;
        powerAddBtn.disabled = powersNb === 0 ? false : true;
    }
    else if (tentaclesNb > 0 && tentaclesNb < 4) {
        tentacleAddBtn.disabled = false;
        tentacleRemoveBtn.disabled = false;
        powerAddBtn.disabled = powersNb === 0 ? false : true;
    }
    else if (tentaclesNb > 4 && tentaclesNb < 8) {
        tentacleAddBtn.disabled = false;
        tentacleRemoveBtn.disabled = false;
        powerAddBtn.disabled = powersNb < 2 ? false : true;
    }
    else if (tentaclesNb === 8) {
        tentacleAddBtn.disabled = true;
        tentacleRemoveBtn.disabled = false;
        powerAddBtn.disabled = powersNb < 3 ? false : true;
    }
};



manageBtnsActivation();