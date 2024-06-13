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

// Envoyer un email à l'administrateur
$admin_email = "antoine.montoya@edu.univ-eiffel.fr";
$admin_subject = "Nouveau commentaire";
$admin_message = "$nom a laissé le commentaire suivant :\n\n $commentaire";
$admin_headers = "From: krousexpress@resaweb.montoya.butmmi.o2switch.site";

mail($admin_email, $admin_subject, $admin_message, $admin_headers);
    
    // Rediriger vers la page des commentaires
    header("Location: index.php#commentaires");
    exit;
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>