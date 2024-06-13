document.addEventListener("DOMContentLoaded", function () {
// pour afficher dynamiquement le prix total en fonction du nombre de places
document.addEventListener('DOMContentLoaded', (event) => {
    const prixElement = document.getElementById('prix');
    const nombrePlacesElement = document.getElementById('nombreplaces');
    const prixTotalElement = document.getElementById('prixtotal');

    function updatePrixTotal() {
        const prix = parseFloat(prixElement.value);
        const nombrePlaces = parseInt(nombrePlacesElement.value);
        const prixTotal = prix * nombrePlaces;
        prixTotalElement.textContent = prixTotal.toFixed(2) + ' €';
    }

    // Initial update
    updatePrixTotal();

    // Update price total when number of places changes
    nombrePlacesElement.addEventListener('change', updatePrixTotal);
});

});