<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
require "./database/db.php";

if (isset($_POST['addEquipement'])) {

    // Collect form data
    $nomEquipement = $_POST['nom'];
    $type = $_POST['type'];
    $qts = $_POST['quantite'];
    $etat = $_POST['etat'];
    

    // Insert query
    $sql = "INSERT INTO Equipement (nomEquipement, typeEquipement, qtsDispo, etat)
            VALUES ('$nomEquipement', '$type', '$qts', '$etat')";

    if ($conn->query($sql)) {
        header("Location: index.php");
    } else {
        echo "<p style='color:red;'>Erreur : " . $conn->error . "</p>";
    }
}
?>