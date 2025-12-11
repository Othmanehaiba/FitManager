<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require "./database/db.php";

// Get course ID
$idCour = $_GET['id'];

// Handle form submission
if (isset($_POST['updateCour'])) {
    $nomCour = $_POST['nom'];
    $categorie = $_POST['categorie'];
    $dateCour = $_POST['date'];
    $heure = $_POST['heure'];
    $duree = $_POST['duree'];
    $nbrMax = $_POST['nbrMax'];

    $sql = "UPDATE Cour SET nomCour='$nomCour', categorie='$categorie', dateCour='$dateCour', 
            heure='$heure', `durée`='$duree', nbrMax='$nbrMax' WHERE idCour='$idCour'";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    }
}


$result = $conn->query("SELECT * FROM Cour WHERE idCour = '$idCour'");
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
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label>Nom du cours *</label>
                        <input type="text" name="nom" value="<?php echo $course['nomCour']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Catégorie *</label>
                        <select name="categorie" required>
                            <option value="Yoga" <?php if($course['categorie']=='Yoga') echo 'selected'; ?>>Yoga</option>
                            <option value="Musculation" <?php if($course['categorie']=='Musculation') echo 'selected'; ?>>Musculation</option>
                            <option value="Cardio" <?php if($course['categorie']=='Cardio') echo 'selected'; ?>>Cardio</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Date *</label>
                        <input type="date" name="date" value="<?php echo $course['dateCour']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Heure *</label>
                        <input type="time" name="heure" value="<?php echo $course['heure']; ?>" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Durée (minutes) *</label>
                        <input type="number" name="duree" value="<?php echo $course['durée']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Max Participants *</label>
                        <input type="number" name="nbrMax" value="<?php echo $course['nbrMax']; ?>" required>
                    </div>
                </div>
                
                <button type="submit" name="updateCour" class="btn btn-primary">Enregistrer</button>
                <a href="index.php" class="btn">Retour</a>
            </form>
        </div>
    </div>
</body>
</html>