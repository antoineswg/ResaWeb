<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krous Express</title>
    <link rel="icon" href="img/logo Krous.svg" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href='index.css'>
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
        <section class="hero">
            <div class="hero-content">
                <h1>Bienvenue sur Krous Express</h1>
                <p>Réservez votre place dans la file d'attente du Crous rapidement et facilement.</p>
                <a href="recherche.php" class="btn-primary">Réserver maintenant</a>
            </div>
        </section>
        
        <section class="how-it-works">
            <h2>Comment ça marche ?</h2>
            <div class="steps">
                <div class="step">
                    <h3>1. Rechercher</h3>
                    <p>Trouvez le lieu et la date qui vous conviennent.</p>
                </div>
                <div class="step">
                    <h3>2. Réserver</h3>
                    <p>Choisissez votre créneau et réservez votre place.</p>
                </div>
                <div class="step">
                    <h3>3. Confirmer</h3>
                    <p>Recevez votre confirmation par email et rendez-vous à l'heure.</p>
                </div>
            </div>
        </section>

        <section>
            <h2>La roulette</h2>
            <p>Vous ne savez pas où réserver ? Laissez-vous guider par la roulette ! Le hasard a choisi deux lieux pour vous, plus qu'à choisir lequel sera le final.</p>
            <div class="grid-lieux">
            <?php
            include("connexion.php");
            $requete = "SELECT * FROM lieu ORDER BY RAND() LIMIT 2";
            $stmt = $db->query($requete);
            $result = $stmt->fetchall(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $id_lieu = $row['id_lieu'];
                $nom = $row['nom'];
                $image = $row['image'];
                $description = $row['desc'];
                $nom = $row['nom'];
                $prix = $row['prix'];
                echo "<div class='grid-lieux-item'>
                    <img src=". $image. ">
                    <h3>".$nom."</h3>
                    <p>".$description."</p>
                    <a href='lieu.php?id=".$id_lieu."'>Accéder à sa page</a>
                </div>";
            }
            if (count($result) === 0) {
                echo "<div class='grid-item'>
                    <p>Aucun lieu trouvé</p>
                    </div>";
            }
            ?>
            </div>

            
        </section>
        
        <section id="commentaires">
            <div class="commentaires-header">
            <h2>Les derniers commentaires</h2>
            <a href="commentaires.php">Accéder à l'ensemble des commentaires</a>
            </div>

            <div class="grid-commentaires">
            <?php
            include("connexion.php");

            // Query to fetch the last two comments from the table
            $query = "SELECT * FROM commentaire ORDER BY id_commentaire DESC LIMIT 3";
            $result = $db->query($query);

            // Check if the query was successful
            if ($result) {
                // Loop through the result set and display the pp value
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $pp=$row['pp'];
                    $nom=$row['nom'];
                    $commentaire=$row['commentaire'];
                    if ($pp != null) {
                        echo "<div class='grid-commentaires-item'>
                        <img src=". $pp. ">
                        <p class='grid-commentaires-item-nom'>".$nom."</p>
                        <p>".$commentaire."</p>
                        </div>";
                    } else {
                        echo "<div class='grid-commentaires-item'>
                        <img src='img/pp.png'>
                        <p class='grid-commentaires-item-nom'>".$nom."</p>
                        <p>".$commentaire."</p>
                        </div>";
                    }
                }
            } else {
                echo "Error executing the query: " . $db->errorInfo()[2];
            }

            // Close the database connection
            $db = null;
            ?>
            </div>
            </div>
        </section>
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