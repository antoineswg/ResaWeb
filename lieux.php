<!-- REGLE OPQUAST N°111 -->
<!-- REGLE OPQUAST N°112 -->
<!-- REGLE OPQUAST N°131 -->
<!-- REGLE OPQUAST N°132 -->
<!-- REGLE OPQUAST N°133 -->
<!-- REGLE OPQUAST N°134 -->
<!-- REGLE OPQUAST N°135 -->
<!-- REGLE OPQUAST N°150 -->
<!-- REGLE OPQUAST N°154 -->
<!-- REGLE OPQUAST N°160 -->
<!-- REGLE OPQUAST N°161 -->
<!-- REGLE OPQUAST N°162 -->
<!-- REGLE OPQUAST N°175 -->
<!-- REGLE OPQUAST N°176 -->
<!-- REGLE OPQUAST N°177 -->
<!-- REGLE OPQUAST N°181 -->
<!-- REGLE OPQUAST N°186 -->
<!-- REGLE OPQUAST N°227 -->


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - Krous' Express</title>
    <link rel="icon" href="img/logo Krous.svg" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="lieu.css">
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
        <h1>Où réserver ?</h1>

        <?php
        include("connexion.php");
        $requete = "SELECT * FROM lieu";
        $stmt = $db->query($requete);
        
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
                foreach ($result as $row){
                    $nom = $row['nom'];
                    $desc = $row['desc'];
                    $prix = $row['prix'];
                    $image = $row['image'];
                    $id_lieu = $row['id_lieu'];
        
                    echo "<div class='card'>
                            <img src='". $image ."' alt='Image de la ". $nom ."'>
                            <div class='card-text'>
                                <h1>". $nom ."</h1>
                                <p>". $desc ."</p>
                                <p>Prix : ". $prix ."€</p>
                                <a href='reserver.php?id=". $id_lieu ."'>Réserver</a>
                            </div>
                        </div>";
        
                }
        
                if (count($result) === 0) {
                    header("Location:404.html");
                }
                ?>

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