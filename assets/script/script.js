// VARIABLES
var searchPopup = document.querySelector('.search-popup'); /* Loupe */
var motdepasse =
  document.getElementById('motdepasse'); /* Force du mot de passe */
var secure = document.getElementById('secure'); /* Force du mot de passe */
// FONCTIONS
// LOUPE
// Ouverture popup recherche navbar
function openSearchPopup() {
  searchPopup.style.display = 'flex';
}
// Fermeture popup recherche navbar
function closeSearchPopup() {
  searchPopup.style.display = 'none';
}
// On fait en fonction de fermer le popup lorsqu'on clique en dehors de celui-ci
window.onclick = function (event) {
  if (event.target == searchPopup) {
    searchPopup.style.display = 'none';
  }
};
// On fait en fonction de fermer le popup lorsqu'on appuie sur la touche ECHAP
window.onkeydown = function (event) {
  if (event.keyCode == 27) {
    searchPopup.style.display = 'none';
  }
  // On fait en sorte d'ouvrir le pop up si on fais CTRL + K
  if (event.key === 'k' && (event.ctrlKey || event.metaKey))
    if (searchPopup.style.display == 'flex') {
      // On empêche le CTRL + K de faire une recherche Google
      event.preventDefault();
      closeSearchPopup();
    } else {
      event.preventDefault();
      openSearchPopup();
    }
};
// MOT DE PASSE
// Affichage mot de passe
function displayPassword() {
  var x = document.getElementById('motdepasse');
  if (x.type === 'password') {
    x.type = 'text';
  } else {
    x.type = 'password';
  }
}
// Affichage confirmation mot de passe
function displayConfirmPassword() {
  var x = document.getElementById('passwordConfirm');
  if (x.type === 'password') {
    x.type = 'text';
  } else {
    x.type = 'password';
  }
}
// Force du mot de passe
motdepasse.addEventListener('input', function () {
  // Regex
  let regexMini = new RegExp('[a-z]');
  let regexMaj = new RegExp('[A-Z]');
  let regexNombre = new RegExp('[0-9]');
  let regexSpec = new RegExp('[@?!$]');
  // Variable de sécurité
  let security = 0;
  // Niveau de sécurité
  if (regexMini.test(motdepasse.value)) {
    security++;
  }
  if (regexMaj.test(motdepasse.value)) {
    security++;
  }
  if (regexNombre.test(motdepasse.value)) {
    security++;
  }
  if (regexSpec.test(motdepasse.value)) {
    security++;
  }
  if (motdepasse.value.length >= 8) {
    security++;
  }
  // Changement du texte en fonction de la sécurité
  if (security == 0) {
    secure.innerHTML = '<p>Inexistant</p>';
  } else if (security == 1) {
    secure.innerHTML = '<p style="color: red">Dangereux</p>';
  } else if (security == 2) {
    secure.innerHTML = '<p style="color: orange">Moyen</p>';
  } else if (security == 3) {
    secure.innerHTML = '<p style="color: gold">Sécurisé</p>';
  } else if (security == 4) {
    secure.innerHTML = '<p style="color: lime">Très sécurisé</p>';
  } else if (security == 5) {
    secure.innerHTML = '<p style="color: deeppink">Ultra sécurisé !</p>';
  }
});
document.getElementById('pageSelector').addEventListener('change', function () {
  var selectedOption = this.options[this.selectedIndex];
  var selectedValue = selectedOption.value;
  if (selectedValue) {
    window.location.href = selectedValue;
  }
});
