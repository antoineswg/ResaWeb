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
    <form method="GET" action="recherche.php">
    <div class="searchbar-total"> <label for="searchbar">
                    <div class="searchbar-button"></div>
                </label>
                <input type="text" id="searchbar" placeholder="Rechercher...">
                <input type="submit" value="Rechercher">
            </div>
    </form>
<?php
include("connexion.php");

if (isset($_GET['search'])) {
    // Récupérer la valeur de la recherche
    $search = $_GET['search'];

    try {
        // Préparer la requête SQL pour récupérer les éléments correspondants à la recherche
        $sql = "SELECT * FROM lieu WHERE nom LIKE :search";
        $stmt = $db->prepare($sql);

        // Lier le paramètre de recherche avec des jokers pour la recherche partielle
        $stmt->bindValue(':search', '%' . $search . '%');

        // Exécuter la requête
        $stmt->execute();

        // Vérifier s'il y a des résultats
        if ($stmt->rowCount() > 0) {
            // Afficher les résultats
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "Nom: " . htmlspecialchars($row['nom']) . "<br>";
                // Afficher d'autres informations si nécessaire
            }
        } else {
            echo "Aucun résultat trouvé.";
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    } finally {
        // Fermer la connexion à la base de données
        $db = null;
    }
}
?>
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