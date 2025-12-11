<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
require "./database/db.php";

if (isset($_POST['addCour'])) {

    // Collect form data
    $nomCour = $_POST['nom'];
    $categorie = $_POST['categorie'];
    $dateCour = $_POST['date'];
    $heure = $_POST['heure'];
    $duree = $_POST['duree'];
    $nbrMax = $_POST['nbrMax'];

    // Insert query
    $sql = "INSERT INTO Cour (nomCour, categorie, dateCour, heure, `durée`, nbrMax)
            VALUES ('$nomCour', '$categorie', '$dateCour', '$heure', '$duree', '$nbrMax')";

    if ($conn->query($sql)) {
        header("Location: index.php");
    } else {
        echo "<p style='color:red;'>Erreur : " . $conn->error . "</p>";
    }
}
?>