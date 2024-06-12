<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krous Express</title>
    <link rel="icon" href="img/logo Krous.svg" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

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
        <div><p>Votre commande a bien été enregistrée et un mail récapitulatif vous a été envoyé. <br> Souhaitez-vous laisser un commentaire ?</p>
<a href="index.php">Non merci</a></div>

<form action='ajout_commentaire.php' method='post'>
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
</body>
</html>