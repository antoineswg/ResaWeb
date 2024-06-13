document.addEventListener("DOMContentLoaded", function () {
// pour afficher dynamiquement le prix total en fonction du nombre de places
var nombrePlaces = document.querySelector("#nombreplaces").value;
var prix = document.querySelector("#prix").value;
var prixTotal= document.querySelector("#prixtotal");

nombrePlacesInput.addEventListener("change", function() {
    var prixTotal = nombrePlaces * prix;
    prixTotal.innerHTLM = prixTotal;
});

});