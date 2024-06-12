<?php
    include("connexion.php");
    $nom = $_POST['nom'];
    $commentaire = $_POST['commentaire'];
    $pp = $_POST['pp'];

        $requete="INSERT INTO commentaire (nom,commentaire,pp) VALUES ('$nom','$commentaire','$pp')";
        $db->query($requete);
        header("Location: index.php");
        exit;
?>