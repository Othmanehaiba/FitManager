<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPro - Gestion Simple</title>
    <link rel="stylesheet" href="./style/style.css">
    </head>
<body>
    <div class="container">
        <h1>🏋️ GymPro - Gestion de Salle de Sport</h1>

        <!-- Navigation Tabs -->
        <div class="tabs">
            <button class="tab active" onclick="showSection('dashboard')">📊 Dashboard</button>
            <button class="tab" onclick="showSection('courses')">📅 Cours</button>
            <button class="tab" onclick="showSection('equipments')">🏋️ Équipements</button>
            <button class="tab" onclick="showSection('associations')">🔗 Associations</button>
            <a href="login.php" class="btn-logout" onclick="return confirm('Voulez-vous vraiment vous déconnecter?')">🚪 Déconnexion</a>
        </div>

        <!-- Dashboard Section -->
        <div id="dashboard" class="section active">
            <div class="stats">
                <div class="stat-card">
                    <h3>Total Cours</h3>
                    <div class="number">
                        <?php
                        require "./database/db.php";

                        $sql = "select count(nomCour) as total from Cour";
                        $row = $conn->query($sql);
                        $res = $row->fetch_assoc();
                        echo"nok22é";
                        echo $res['total'];
                        ?>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Total Équipements</h3>
                    <div class="number">
                        <?php
                        require "./database/db.php";

                        $sql = "select count(idEquipement) as total from Equipement";
                        $row = $conn->query($sql);
                        $res = $row->fetch_assoc();
                        echo $res['total'];
                        ?>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Disponible</h3>
                    <div class="number">
                        <?php
                        require "./database/db.php";

                        $sql = "select count(idEquipement) as total from Equipement where etat like 'Disponible'";
                        $row = $conn->query($sql);
                        $res = $row->fetch_assoc();
                        echo $res['total'];
                        ?>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>En maintenance</h3>
                    <div class="number">
                        <?php
                        require "./database/db.php";

                        $sql = "select count(idEquipement) as total from Equipement where etat like 'En maintenance'";
                        $row = $conn->query($sql);
                        $res = $row->fetch_assoc();
                        echo $res['total'];
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Section -->
        <div id="courses" class="section">
            <!-- Add Course Form -->
            <div class="form-container">
                <h2>Ajouter un Cours</h2>
                <form action="add_course.php" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nom du cours *</label>
                            <input type="text" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label>Catégorie *</label>
                            <select name="categorie" required>
                                <option value="">Sélectionner...</option>
                                <option value="Yoga">Yoga</option>
                                <option value="Musculation">Musculation</option>
                                <option value="Cardio">Cardio</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Date *</label>
                            <input type="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label>Heure *</label>
                            <input type="time" name="heure" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Durée (minutes) *</label>
                            <input type="number" name="duree" required>
                        </div>
                        <div class="form-group">
                            <label>Max Participants *</label>
                            <input type="number" name="nbrMax" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter le cours</button>
                </form>
            </div>

            <!-- Courses List -->
            <h2>Liste des Cours</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Durée</th>
                        <th>Max</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require "./database/db.php";
                    $row = $conn->query('select * from Cour');
                    $res = $row->fetch_assoc();
                    foreach($res as $re){
                    echo "
                    <tr>
                        <td>$re[nomCour]</td>
                        <td>$re[categorie]</td>
                        <td>$re[date]</td>
                        <td>$re[heure]</td>
                        <td>$re[duree] min</td>
                        <td>$re[nbrMax]</td>
                        <td class='actions'>
                            <a href='edit_course.php?id=2' class='btn btn-warning btn-small'>✏️ Modifier</a>
                            <a href='delete_course.php?id=2' class='btn btn-danger btn-small' onclick='return confirm('Supprimer ce cours?')'>🗑️ Supprimer</a>
                        </td>
                    </tr>
                    ";
                    }
                    ?>
                    
                </tbody>
            </table>
        </div>

        <!-- Associations Section -->
        <div id="associations" class="section">
            <!-- Add Association Form -->
            <div class="form-container">
                <h2>Créer une Association Cours-Équipement</h2>
                <form action="add_association.php" method="POST">
                    <div class="form-group">
                        <label>Sélectionner un cours *</label>
                        <select name="idCour" required>
                            <option value="">Choisir un cours...</option>
                            <?php
                            // Example PHP code
                            // include 'db.php';
                            // $result = $conn->query("SELECT idCour, nomCour, dateCour, heure FROM Cour");
                            // while($row = $result->fetch_assoc()) {
                            //     echo "<option value='{$row['idCour']}'>{$row['nomCour']} - {$row['dateCour']} {$row['heure']}</option>";
                            // }
                            ?>
                            <option value="1">Yoga Débutant - 2024-12-10 10:00</option>
                            <option value="2">Musculation Avancée - 2024-12-11 14:00</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sélectionner un équipement *</label>
                        <select name="idEquipement" required>
                            <option value="">Choisir un équipement...</option>
                            <?php
                            // Example PHP code
                            // $result = $conn->query("SELECT idEquipement, nomEquipement FROM Equipement WHERE etat='Disponible'");
                            // while($row = $result->fetch_assoc()) {
                            //     echo "<option value='{$row['idEquipement']}'>{$row['nomEquipement']}</option>";
                            // }
                            ?>
                            <option value="1">Tapis de course</option>
                            <option value="2">Haltères 10kg</option>
                            <option value="3">Tapis de yoga</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Créer l'association</button>
                </form>
            </div>

            <!-- Associations List -->
            <h2>Liste des Associations</h2>
            <div class="association-cards">
                <?php
                // Example PHP code to display associations
                // include 'db.php';
                // $sql = "SELECT ce.id, c.nomCour, c.dateCour, c.heure, e.nomEquipement 
                //         FROM cour_equipement ce 
                //         JOIN Cour c ON ce.idCour = c.idCour 
                //         JOIN Equipement e ON ce.idEquipement = e.idEquipement";
                // $result = $conn->query($sql);
                // while($row = $result->fetch_assoc()) {
                ?>
                <div class="association-card">
                    <h3>Yoga Débutant</h3>
                    <p>📅 2024-12-10 - ⏰ 10:00</p>
                    <div class="equipment-tags">
                        <span class="equipment-tag">Tapis de yoga</span>
                        <span class="equipment-tag">Bloc de yoga</span>
                    </div>
                    <div class="actions">
                        <a href="delete_association.php?id=1" class="btn btn-danger btn-small" onclick="return confirm('Supprimer cette association?')">🗑️ Supprimer</a>
                    </div>
                </div>

                <div class="association-card">
                    <h3>Musculation Avancée</h3>
                    <p>📅 2024-12-11 - ⏰ 14:00</p>
                    <div class="equipment-tags">
                        <span class="equipment-tag">Haltères 10kg</span>
                        <span class="equipment-tag">Banc de musculation</span>
                        <span class="equipment-tag">Barre de traction</span>
                    </div>
                    <div class="actions">
                        <a href="delete_association.php?id=2" class="btn btn-danger btn-small" onclick="return confirm('Supprimer cette association?')">🗑️ Supprimer</a>
                    </div>
                </div>

                <div class="association-card">
                    <h3>Cardio Intensif</h3>
                    <p>📅 2024-12-12 - ⏰ 09:00</p>
                    <div class="equipment-tags">
                        <span class="equipment-tag">Tapis de course</span>
                        <span class="equipment-tag">Vélo elliptique</span>
                    </div>
                    <div class="actions">
                        <a href="delete_association.php?id=3" class="btn btn-danger btn-small" onclick="return confirm('Supprimer cette association?')">🗑️ Supprimer</a>
                    </div>
                </div>
                <?php
                // }
                ?>
            </div>
        </div>

        <!-- Equipments Section -->
        <div id="equipments" class="section">
            <!-- Add Equipment Form -->
            <div class="form-container">
                <h2>Ajouter un Équipement</h2>
                <form action="add_equipment.php" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nom de l'équipement *</label>
                            <input type="text" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label>Type *</label>
                            <select name="type" required>
                                <option value="">Sélectionner...</option>
                                <option value="Cardio">Cardio</option>
                                <option value="Musculation">Musculation</option>
                                <option value="Yoga">Yoga</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Quantité *</label>
                            <input type="number" name="quantite" required>
                        </div>
                        <div class="form-group">
                            <label>État *</label>
                            <select name="etat" required>
                                <option value="Disponible">Disponible</option>
                                <option value="En maintenance">En maintenance</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter l'équipement</button>
                </form>
            </div>

            <!-- Equipments List -->
            <h2>Liste des Équipements</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Quantité</th>
                        <th>État</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Example PHP code to display equipment
                    // include 'db.php';
                    // $result = $conn->query("SELECT * FROM Equipement");
                    // while($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>Tapis de course</td>
                        <td>Cardio</td>
                        <td>5</td>
                        <td>Disponible</td>
                        <td class="actions">
                            <a href="edit_equipment.php?id=1" class="btn btn-warning btn-small">✏️ Modifier</a>
                            <a href="delete_equipment.php?id=1" class="btn btn-danger btn-small" onclick="return confirm('Supprimer cet équipement?')">🗑️ Supprimer</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Haltères 10kg</td>
                        <td>Musculation</td>
                        <td>20</td>
                        <td>Disponible</td>
                        <td class="actions">
                            <a href="edit_equipment.php?id=2" class="btn btn-warning btn-small">✏️ Modifier</a>
                            <a href="delete_equipment.php?id=2" class="btn btn-danger btn-small" onclick="return confirm('Supprimer cet équipement?')">🗑️ Supprimer</a>
                        </td>
                    </tr>
                    <?php
                    // }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="./style/main.js"></script>
    </body>
</html>