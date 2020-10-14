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