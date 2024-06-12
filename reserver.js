// pour afficher dynamiquement le prix total en fonction du nombre de places
var nbplaces = document.getElementById("nombreplaces");
var afficheprixtotal = document.getElementById("prixtotal");
var prix = document.getElementById("prix");
var nbplacesnombre = parseInt(nbplaces.value);
afficheprixtotal.innerHTML = nbplacesnombre * prix.innerHTML + "€";
nbplaces.addEventListener("change", function () {
var nbplacesnombre = parseInt(nbplaces.value);
afficheprixtotal.innerHTML = nbplacesnombre * prix.innerHTML + "€";
});