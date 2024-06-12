<?php
    include("connexion.php");
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $nb_places = $_POST['nombreplaces'];
    $date = $_POST['date'];
    $prix_individuel = $_POST['prix'];
    $id_lieu = $_POST['id_lieu'];
    $prix = $prix_individuel * $nb_places;

        $requete="INSERT INTO reservation (date,nom,prenom,mail,prix,nb_places,id_lieu) VALUES ('$date','$nom','$prenom','$email','$prix','$nb_places','$id_lieu')";
        $db->query($requete);
        
    // $message="Merci $prenom pour ta réservation chez Krous'Express ! Tu as réservé $nb_places billets pour $prix €. Nous te confirmons ta réservation pour le $date. À bientôt !";
    // $to=$email;
    // $subject="Votre réservation chez Krous'Express";
    // mail($to, $subject, $message);
    header("Location: avis.php");
?>