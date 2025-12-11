<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require "./database/db.php";

// Get course ID
$idE = $_GET['id'];

// Handle form submission
if (isset($_POST['editEquipement'])) {
    $nomEquipement = $_POST['nom'];
    $type = $_POST['type'];
    $qts = $_POST['quantite'];
    $etat = $_POST['etat'];


    $sql = "UPDATE Equipement SET nomEquipement='$nomEquipement', qtsDispo='$qts', etat='$etat' WHERE idEquipement='$idE'";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    }
}

// Get course data
$result = $conn->query("SELECT * FROM Equipement WHERE idEquipement = '$idE'");
$course = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Cours</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <div class="container">
        <h1>Modifier un Cours</h1>
        
        <div class="form-container">
            <form action="" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nom de l'équipement *</label>
                            <input type="text" name="nom" value="<?php echo $course['nomEquipement']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Type *</label>
                            <select name="type" required>
                                <option value="">Sélectionner...</option>
                                <option value="Cardio" <?php if($course['typeEquipement']=='Cardio') echo 'selected'; ?>>Cardio</option>
                                <option value="Musculation" <?php if($course['typeEquipement']=='Musculation') echo 'selected'; ?>>Musculation</option>
                                <option value="Yoga" <?php if($course['typeEquipement']=='Yoga') echo 'selected'; ?>>Yoga</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Quantité *</label>
                            <input type="number" name="quantite" value="<?php echo $course['qtsDispo']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>État *</label>
                            <select name="etat" required>
                                <option value="Bon" <?php if($course['etat']=='Bon') echo 'selected'; ?>>Bon</option>
                                <option value="Moyen" <?php if($course['etat']=='Moyen') echo 'selected'; ?>>Moyen</option>
                                <option value="A Remplacer" <?php if($course['etat']=='A Remplacer') echo 'selected'; ?>>A Remplacer</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="editEquipement">Update Equipement</button>
                </form>
        </div>
    </div>
</body>
</html>