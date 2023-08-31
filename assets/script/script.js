// VARIABLES
var searchPopup = document.querySelector('.search-popup');
// FONCTIONS
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
// On fait en fonction de fermer le popup lorsqu'on appuie sur la touche echap
window.onkeydown = function (event) {
  if (event.keyCode == 27) {
    searchPopup.style.display = 'none';
  }
};
