<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require "./database/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idCour = $_POST['idCour'];
    $idEquipement = $_POST['idEquipement'];
    
    // Insert the association
    $sql = "INSERT INTO cour_equipement (idCour, idEquipement) VALUES ('$idCour', '$idEquipement')";
    
    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<p style='color:red;'>Erreur : " . $conn->error . "</p>";
        echo "<a href='index.php'>Retour</a>";
    }
} else {
    header("Location: index.php");
    exit();
}
?>