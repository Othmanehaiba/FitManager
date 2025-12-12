<?php
include './database/db.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];    
 
    
    $sql = "DELETE FROM cour_equipement WHERE idCour = '$id'";
    $result = $conn->query($sql);
    
    if($result){
        header("Location: index.php");
        exit();
    }
} else {
    
    echo "NOK2";
    // header("Location: index.php");
    // exit();
}
$conn->close();
?>