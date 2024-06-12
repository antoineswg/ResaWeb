<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krous Express</title>
    <link rel="icon" href="img/logo Krous.svg" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="avis.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <a class="evitement" href="#contenu">Aller au contenu</a>
    <header name="top">
        <a href="index.php"><img class="logo-header" src="img/logo Krous.svg" alt="Accueil"></a>
        <div class="header-links">

            <div class="searchbar-total"> <label for="searchbar">
                    <div class="searchbar-button"></div>
                </label>
                <input type="text" id="searchbar" placeholder="Rechercher...">
            </div>

            <a href="lieux.php">Catalogue</a>
            <a href="about.html">À propos</a>
            <a href="page.php">Page3</a>
            <a href="page.php">Page4</a>
        </div>
    </header>
    <main id="contenu">
<?php
    include("connexion.php");
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $nb_places = $_POST['nombreplaces'];
    $date = $_POST['date'];
    $prix_individuel = $_POST['prix'];
    $id_lieu = $_POST['id_lieu'];
    $prix = $prix_individuel * $nb_places;

        $requete="INSERT INTO reservation (date,nom,prenom,mail,prix,nb_places,id_lieu) VALUES ('$date','$nom','$prenom','$email','$prix','$nb_places','$id_lieu')";
        $db->query($requete);

    // $message="Merci $prenom pour ta réservation chez Krous'Express ! Tu as réservé $nb_places billets pour $prix €. Nous te confirmons ta réservation pour le $date. À bientôt !";
    // $to=$email;
    // $subject="Votre réservation chez Krous'Express";
    // mail($to, $subject, $message);
?>

<div><p>Votre commande a bien été enregistrée et un mail récapitulatif vous a été envoyé. <br> Souhaitez-vous laisser un commentaire ?</p>
<a href="index.php">Non merci</a></div>

<form action='add_comment.php' method='post'>
    <label for='nom' >Pseudonyme ou nom à afficher<span class='required'>*</span></label> 
    <input type='text' name='nom' id='nom' maxlength='40' required>
<br>
    <label for='pp' >Votre photo de profil</label> 
    <input type='url' name='pp' placeholder='Vérifiez à bien mettre le lien vers une image' id='pp'>
<br>
    <label for='commentaire' >Votre commentaire<span class='required'>*</span></label>
    <input type='textarea' name='commentaire' id='commentaire' maxlength='255' required>
<br>
<input type='submit' value='Commenter'>
<p>Les symboles <span class='required'>*</span> indiquent un champ obligatoire</p>
</form>

    </main>
    <footer>
        <a href="#top" class="totop">RETOUR EN HAUT ↑</a>
        <div class="basPage invis">
            <h2 class="ML">Mentions légales</h2>
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
            </p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>

</html>