<?php
include './database/db.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    
    //$id = $conn->real_escape_string($id);
    
 
    $deleteAssoc = $conn->query("DELETE FROM cour_equipement WHERE idCour = '$id'");
    
    $sql = "DELETE FROM Cour WHERE idCour = '$id'";
    $result = $conn->query($sql);
    
    if($result){
        header("Location: index.php");
        exit();
    }
} else {
    
    header("Location: index.php");
    exit();
}
$conn->close();
?>