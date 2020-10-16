let tentacleDeleteForm , tentacleDeleteSelect, tentacleCancelDeleteBtn;



const watchTentacleForm = () => {
    // the form
     tentacleDeleteForm = document.querySelector('#tentacle-remove-form');
     tentacleDeleteSelect = document.querySelector('#tentacle-delete-select');

     tentacleCancelDeleteBtn = document.querySelector('#tentacle-delete-close');




     tentacleCancelDeleteBtn.addEventListener('click', () => {
         console.log('coucou')
             cleanAndHideForm();
             unenlightBtns();
         });
     
     
     tentacleDeleteForm.addEventListener('submit', (e) => {
         e.preventDefault();
         data = {
             'krakenId': e.target.dataset.krakenId,
             'tentacleId': tentacleDeleteSelect.value
         };
     
         fetch('/tentacle/delete', {
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
                 // TODO gérer les erreurs
             }
             else {
                 console.log(response.tentacleHtml)
                 tentacleInfosDiv.innerHTML = response.tentacleHtml;
                 tentacleRemoveDiv.innerHTML = response.removableTentaclesHtml;
                 cleanAndHideForm();
                 unenlightBtns();
                 manageBtnsActivation();
                 watchTentacleForm();
             }
         })
     });
}



watchTentacleForm();