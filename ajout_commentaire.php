<?php
include("connexion.php");

// Récupérer les données POST et les filtrer pour éviter les injections SQL
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);
$pp = filter_input(INPUT_POST, 'pp', FILTER_SANITIZE_STRING);

// Préparer et exécuter la requête SQL
try {
    $requete = $db->prepare("INSERT INTO commentaire (nom, commentaire, pp) VALUES (:nom, :commentaire, :pp)");
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':commentaire', $commentaire);
    $requete->bindParam(':pp', $pp);
    $requete->execute();
    
    // Rediriger vers la page des commentaires
    header("Location: index.php#commentaires");
    exit;
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
