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
    // Récupérer le nom du lieu
    $lieu_requete = $db->prepare("SELECT nom FROM lieu WHERE id_lieu = :id_lieu");
    $lieu_requete->bindParam(':id_lieu', $id_lieu);
    $lieu_requete->execute();
    $lieu_result = $lieu_requete->fetch(PDO::FETCH_ASSOC);

    if ($lieu_result) {
        $lieu_nom = $lieu_result['nom'];
    } else {
        throw new Exception("Lieu non trouvé.");
    }

    // Préparer et exécuter la requête SQL pour insérer la réservation
    $requete = $db->prepare("INSERT INTO reservation (date, nom, prenom, mail, prix, nb_places, id_lieu) VALUES (:date, :nom, :prenom, :email, :prix, :nb_places, :id_lieu)");
    $requete->bindParam(':date', $date);
    $requete->bindParam(':nom', $nom);
    $requete->bindParam(':prenom', $prenom);
    $requete->bindParam(':email', $email);
    $requete->bindParam(':prix', $prix);
    $requete->bindParam(':nb_places', $nb_places);
    $requete->bindParam(':id_lieu', $id_lieu);
    $requete->execute();

    // Convertir la date au format DD/MM/YYYY à HH:MM
    $datetime = new DateTime($date);
    $formatted_date = $datetime->format('d/m/Y \à H:i');

    // Envoyer un email à l'administrateur
    $admin_email = "antoine.montoya@edu.univ-eiffel.fr";
    $admin_subject = "Nouvelle réservation";
    $admin_message = "$prenom $nom a réservé $nb_places places pour le $formatted_date à la $lieu_nom (site n°$id_lieu) pour un total de $prix.";
    $admin_headers = "From: krousexpress@resaweb.montoya.butmmi.o2switch.site";

    mail($admin_email, $admin_subject, $admin_message, $admin_headers);

    // Envoyer un email de confirmation au client
    $client_subject = "Confirmation de votre réservation";
    $client_message = "Merci $prenom pour ta réservation de $nb_places places prévue au $formatted_date à la $lieu_nom.\nLe prix total de ta commande est de $prix €.\n\nÀ bientôt !";
    $client_headers = "From: krousexpress@resaweb.montoya.butmmi.o2switch.site";

    mail($email, $client_subject, $client_message, $client_headers);

    // Rediriger vers la page de confirmation
    header("Location: confirmation.html");
    exit;
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}
?>
