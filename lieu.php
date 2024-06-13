<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krous Express</title>
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
    <?php
include("connexion.php");

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id_lieu = intval($_GET["id"]);
    
    try {
        $requete = "SELECT * FROM lieu WHERE id_lieu = :id_lieu";
        $stmt = $db->prepare($requete);
        $stmt->bindParam(':id_lieu', $id_lieu, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $nom = $result['nom'];
            $desc = $result['desc'];
            $prix = $result['prix'];
            $image = $result['image'];

            echo "<div class='card'>
                    <img src='". $image ."' alt='Image de ". $nom ."'>
                    <div class='card-text'>
                        <h1>". $nom ."</h1>
                        <p>". $desc ."</p>
                        <p>Prix : ". $prix ."€</p>
                        <a href='reserver.php?id=". $id_lieu ."'>Réserver</a>
                    </div>
                </div>";
        } else {
            header("Location:404.html");
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    } finally {
        // Fermer la connexion à la base de données
        $db = null;
    }
} else {
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