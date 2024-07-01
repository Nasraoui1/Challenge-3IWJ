let fIdInput = document.getElementById("IdR");
let fTypeInput = document.getElementById("typeR");
let fDescriptionInput = document.getElementById("descriptionR");
var letters = /^[A-Za-z]+$/;
let errors = false;

function IdValidation(fIdInput) {
  if (isNaN(fIdInput.value) || fIdInput.value.length < 3) {
    alert('Veuillez entrer un id valide ! (seulement des chiffres)');
    return true;
  } else {
    return false;
  }
}

function TypeValidation(fTypeInput) {
  if (fTypeInput.value.length < 3 || !fTypeInput.value.match(letters)) {
    alert('Type incorrect');
    return true;
  } else {
    return false;
  }
}

function DescriptionValidation(fDescriptionInput) {
  if (fDescriptionInput.value.length < 3 || !fDescriptionInput.value.match(letters)) {
    alert('Description incorrecte');
    return true;
  } else {
    return false;
  }
}

function handleSubmit(event) {
    let form = document.getElementById('f');
    errors = false;
    errors = errors || IdValidation(fIdInput);
    errors = errors || TypeValidation(fTypeInput);
    errors = errors || DescriptionValidation(fDescriptionInput);
    if (errors) {
      event.preventDefault();
    }
  }
  
  document.getElementById('f').addEventListener('submit', handleSubmit);