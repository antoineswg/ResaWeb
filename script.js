document.addEventListener("DOMContentLoaded", function () {
  
  document.querySelector(".invis").addEventListener("click", function () {
    //Animer le volet pour le dérouler
    document.querySelector(".invis").animate(
      [
        {
          height: "37em",
        },
      ],
      {
        duration: 800,
      }
    );
    setTimeout(function f() {
      //Attribuer la classe vis à la place de la classe invis
      document.querySelector(".invis").classList.replace("invis", "vis");
    }, 800);
  });
  //Refermer le volet
  document.querySelector(".basPage").addEventListener("click", function () {
    document.querySelector(".vis").animate(
      [
        {
          height: "4em",
        },
      ],
      {
        duration: 800,
      }
    );
    setTimeout(function f() {
      //Attribuer la classe invis à la place de la classe vis
      document.querySelector(".vis").classList.replace("vis", "invis");
    }, 800);
  });

  
// pour afficher dynamiquement le prix total en fonction du nombre de places
  var nbplaces = document.getElementById("nombreplaces");
  var prixtotal = document.getElementById("prixtotal");
  var prix = document.getElementById("prix");
  var nbplacesnombre = parseInt(nbplaces.value);
  prixtotal.innerHTML = nbplacesnombre * prix.innerHTML + "€";
  nbplaces.addEventListener("change", function () {
    var nbplacesnombre = parseInt(nbplaces.value);
    prixtotal.innerHTML = nbplacesnombre * prix.innerHTML + "€";
  });
});
