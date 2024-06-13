<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche - Krous' Express</title>
    <link rel="icon" href="img/logo Krous.svg" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href='recherche.css'>
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
    <form method="GET" action="recherche.php">

            <div class="categorie">
                <p class="titre-categorie">Catégorie :</p>
            <label for="cantine">Cantine</label>
            <input id="cantine" name="cantine" type="checkbox">
            <br>
            <label for="cafeteria">Cafétéria</label>
            <input id="cafeteria" name="cafeteria" type="checkbox">
            </div>
            <div class="batiment">
                <p class="titre-categorie">Bâtiment :</p>
            <label for="copernic">Copernic</label>
            <input id="copernic" name="copernic" type="checkbox">
            <br>
            <label for="esiee">ESIEE</label>
            <input id="esiee" name="esiee" type="checkbox">
            <br>
            <label for="iut">IUT</label>
            <input id="iut" name="iut" type="checkbox">
            <br>
            <label for="lavoisier">Lavoisier</label>
            <input id="lavoisier" name="lavoisier" type="checkbox">
            </div>
            <div class="tri">
                <br>
            <label class="titre-categorie" for="tri">Trier par :</label>
            <select name="tri" id="tri" class="input-tri">
                <option value="nom">Nom</option>
                <option value="prix">Prix</option>
            </select>
            </div>
            <div class="wrapper-searchbar">
            <input type="text" id="searchbar" name="searchbar" placeholder="Rechercher..." onkeydown="if(event.keyCode==13) this.form.submit();">
            <label for="searchbar"><div class="searchbar-button"></div></label>
            </div>
        </form>
        <br>
        <img src="" alt="">
        
        <?php
        include("connexion.php");
        if (isset($_GET['searchbar'])) {
            // Récupérer la valeur de la recherche
            $search = $_GET['searchbar'];

            // Vérifier les cases cochées
            $cantineChecked = isset($_GET['cantine']);
            $cafeteriaChecked = isset($_GET['cafeteria']);
            $copernicChecked = isset($_GET['copernic']);
            $esieeChecked = isset($_GET['esiee']);
            $iutChecked = isset($_GET['iut']);
            $lavoisierChecked = isset($_GET['lavoisier']);

            // Récupérer l'option de tri
            $tri = isset($_GET['tri']) ? $_GET['tri'] : 'nom';

            try {
                // Préparer la requête SQL pour récupérer les éléments correspondants à la recherche
                $sql = "SELECT * FROM lieu";
                
                // Conditions pour les catégories
                $conditions = [];
                if ($cantineChecked) {
                    $conditions[] = "categorie.nom_categorie = 'cantine'";
                }
                if ($cafeteriaChecked) {
                    $conditions[] = "categorie.nom_categorie = 'cafeteria'";
                }
                
                // Conditions pour les bâtiments
                $buildingConditions = [];
                if ($copernicChecked) {
                    $buildingConditions[] = "batiment.nom_batiment = 'Copernic'";
                }
                if ($esieeChecked) {
                    $buildingConditions[] = "batiment.nom_batiment = 'ESIEE'";
                }
                if ($iutChecked) {
                    $buildingConditions[] = "batiment.nom_batiment = 'IUT'";
                }
                if ($lavoisierChecked) {
                    $buildingConditions[] = "batiment.nom_batiment = 'Lavoisier'";
                }

                // Joindre les tables si nécessaire
                if (!empty($conditions) || !empty($buildingConditions)) {
                    if (!empty($conditions)) {
                        $sql .= " INNER JOIN categorie ON lieu.id_categorie = categorie.id_categorie";
                    }
                    if (!empty($buildingConditions)) {
                        $sql .= " INNER JOIN batiment ON lieu.id_batiment = batiment.id_batiment";
                    }
                }
                
                // Ajouter les conditions de filtre
                if (!empty($conditions)) {
                    $sql .= " WHERE (" . implode(" OR ", $conditions) . ")";
                }
                if (!empty($buildingConditions)) {
                    if (!empty($conditions)) {
                        $sql .= " AND (" . implode(" OR ", $buildingConditions) . ")";
                    } else {
                        $sql .= " WHERE (" . implode(" OR ", $buildingConditions) . ")";
                    }
                }
                
                // Ajouter la condition de recherche
                if (!empty($conditions) || !empty($buildingConditions)) {
                    $sql .= " AND lieu.nom LIKE :search";
                } else {
                    $sql .= " WHERE lieu.nom LIKE :search";
                }

                // Ajouter l'ordre de tri
                if ($tri == 'prix') {
                    $sql .= " ORDER BY lieu.prix";
                } else {
                    $sql .= " ORDER BY lieu.nom";
                }

                $stmt = $db->prepare($sql);

                // Lier le paramètre de recherche avec des jokers pour la recherche partielle
                $stmt->bindValue(':search', '%' . $search . '%');

                // Exécuter la requête
                $stmt->execute();

                // Vérifier s'il y a des résultats
                if ($stmt->rowCount() > 0) {
                    // Afficher les résultats
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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