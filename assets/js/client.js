let fidInput = document.getElementById("Id");
let fprenomInput = document.getElementById("prenom");
let fnomInput = document.getElementById("nom");
let fcontenuInput = document.getElementById("contenu");
let fdateInput = document.getElementById("date");

var letters = /^[A-Za-z]+$/;
let errors = false;

function id(fidInput) {
  if (isNaN(fidInput.value) || fidInput.value.length < 3) {
    alert('Veuillez entrer un id valide ! (seulement des chiffres)');
    return true;
  } else {
    return false;
  }
}
function prenom(fprenomInput) {
  if (fTypeInput.value.length < 3 || !fTypeInput.value.match(letters)) {
    alert('prenom incorrect');
    return true;
  } else {
    return false;
  }
}

function nom(fnomInput) {
  if (fnomInput.value.length < 3 || !fnomInput.value.match(letters)) {
    alert('nom incorrect');
    return true;
  } else {
    return false;
  }
}

function contenuValidation(fcontenuInput) {
  if (fcontenuInput.value.length < 3 || !fcontenuInput.value.match(letters)) {
    alert('contenu incorrecte');
    return true;
  } else {   
    return false;
  }
}

function handleSubmit(event) {
    let form = document.getElementByid('f');
    errors = false;
    errors = errors || id(fidInput);
    errors = errors || prenom(fprenomInput);
    errors = errors || nom(fnomInput);
    errors = errors || contenuValidation(fcontenuInput);
    if (errors) {
      event.preventDefault();
    }
  }
  
  document.getElementById('f').addEventListener('submit', handleSubmit);