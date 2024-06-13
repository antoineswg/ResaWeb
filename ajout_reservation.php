<?php
include("connexion.php");

// Récupérer les données POST et les filtrer pour éviter les injections SQL
$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$nb_places = filter_input(INPUT_POST, 'nombreplaces', FILTER_SANITIZE_NUMBER_INT);
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
$prix_individuel = filter_input(INPUT_POST, 'prix', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$id_lieu = filter_input(INPUT_POST, 'id_lieu', FILTER_SANITIZE_NUMBER_INT);

// Calculer le prix total
$prix = $prix_individuel * $nb_places;

try {
    // Préparer et exécuter la requête SQL
    $requete = $db->prepare("INSERT INTO reservation (date, nom, prenom, mail, prix, nb_places, id_lieu) VALUES (:date, :nom, :prenom, :email, :prix, :nb_places, :id_lieu)");
    $requete->bindParam(':date', $date);
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':prenom', $prenom);
    $requete->bindParam(':email', $email);
    $requete->bindParam(':prix', $prix);
    $requete->bindParam(':nb_places', $nb_places);
    $requete->bindParam(':id_lieu', $id_lieu);
    $requete->execute();
    exit;
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}


        $subject="Réservation chez Krous' Express";

        $message="Merci $prenom pour ta réservation prévue au $date.
        Nombre de places : $nb_places.
        Total : $prix €";
                 
        $to=$email;

        $messageantoine="$prenom $nom a réservé $nb_places places pour le $date au site n°$id_lieu pour un total de $prix."

        $mailantoine="antoine.montoya@edu.univ-eiffel.fr";

        $subject2="Réservation Krous' Express";

        mail($to, $subject, $message);

        mail($mailantoine, $subject2, $messageantoine);

        // Rediriger vers la page de confirmation
        header("Location: confirmation.html");
?>