<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krous Express</title>
    <link rel="icon" href="img/logo Krous.svg" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="reserver.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<?php
include("connexion.php");
$requete = "SELECT * FROM lieu WHERE id_lieu = " . $_GET["id"];
$stmt = $db->query($requete);
$resultat = $stmt->fetchall(PDO::FETCH_ASSOC);
?>


<body>
    <a class="evitement" href="#contenu">Aller au contenu</a>
    <header name="top">
        <a href="index.php"><img class="logo-header" src="img/logo Krous.svg" alt="Accueil"></a>
        <div class="header-links">
            <a class="header-link" href="recherche.php">Rechercher</a>
            <a class="header-link" href="lieux.php">Catalogue</a>
            <a class="header-link" href="about.html">À propos</a>
            <a class="header-link" href="commentaires.php">Nos commentaires</a>
        </div>
    </header>
    <main id="contenu">

    <?php foreach ($resultat as $row){
    echo "    <form action='ajout_reservation.php' method='post'>

    <input type='hidden' name='id_lieu' id='id_lieu' value='{$row["id_lieu"]}'>
    <input type='hidden' name='prix' id='prix' value='{$row["prix"]}'>

    <label for='prenom' >Prénom<span class='required'>*</span></label> 
    <input type='text' name='prenom' id='prenom' maxlength='40' required>
<br>
    <label for='nom' >Nom<span class='required'>*</span></label>
    <input type='text' name='nom' id='nom' maxlength='40' required>
<br>
    <label for='email' >E-mail<span class='required'>*</span></label>
    <input type='email' name='email' id='email' maxlength='100' required>
<br>
    <label for='nombreplaces'>Pour combien de personnes réservez-vous ?<span class='required'>*</span></label>
    <select name='nombreplaces' id='nombreplaces'>
    <option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
</select><br>
    <label for='date'>Date de réservation<span class='required'>*</span></label>
    <input type='datetime-local' name='date' id='date' required>
<br>
<input type='submit' value='Réserver'>
<p>Les symboles <span class='required'>*</span> indiquent un champ obligatoire</p>
<br>
</form>";} ?>




<?php foreach ($resultat as $lieu) echo "<p type='hidden' name='{$lieu["id_lieu"]}'></p>" ?></p>
    <p hidden id="prix"><?php foreach ($resultat as $lieu) echo "{$lieu["prix"]}" ?></p>
    <p>Prix à payer TTC :  <span name='prixtotal' id="prixtotal"></span></p>



    </main>
    
    <footer>
        <div class="basPage invis">
            <div class="footer-header">            
            <h2 class="ML">Mentions légales</h2>
            <a href="#top" class="totop">RETOUR EN HAUT ↑</a>   
            </div>
            <p>Site réalisé par Antoine Montoya en 2024 dans le cadre d'un projet du BUT MMI à l'IUT de
                Champs-sur-Marne encadré par les enseignants Gaëlle Charpentier, Philippe Gambette, Matthieu
                Berthet et Renaud Eppstein.
                <br>Ce site est hébergé par o2switch
                <br>Coordonnées : Adresse : Chem. des Pardiaux, 63000 Clermont-Ferrand, France - Tél : +33 4 44 44 60 40 
            </p>
            <h3>Traitement des données à caractère personnel :</h3>
            <p>Le formulaire utilisé pour faire une réservation collecte votre adresse email, votre nom, votre prénom, votre prx à payer ainsi que le lieu de réservation. Ces données ne
                seront en aucun cas partagées ou commercialisées.
                <br>Toute question relative à la récupération et conservation de vos données se doit d'être adressée à
                <a href="mailto:antoine.montoya@edu.univ-eiffel.fr">Antoine Montoya</a>.
                Pour la version détaillée des crédits : <a href="credits.html">Cliquez ici</a>
            </p>
        </div>
    </footer>
    <script src="script.js"></script>
    <script src="reserver.js"></script>
</body>

</html>