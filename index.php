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
        <h1>🏋️ FitManager - Gestion de Salle de Sport</h1>

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
                            $sql = $conn->query('select count(nomCour) as total from Cour');
                            $res = $sql->fetch_assoc();
                            echo $res['total'];
                        ?>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Total Équipements</h3>
                    <div class="number">
                        <?php
                            require "./database/db.php";
                            $sql = $conn->query('select count(nomEquipement) as total from Equipement');
                            $res = $sql->fetch_assoc();
                            echo $res['total'];
                        ?>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Bon</h3>
                    <div class="number">
                        <?php
                            require "./database/db.php";
                            $sql = $conn->query('select count(nomEquipement) as total from Equipement where etat like "Bon"');
                            $res = $sql->fetch_assoc();
                            echo $res['total'];
                        ?>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Moyen</h3>
                    <div class="number">
                        <?php
                            require "./database/db.php";
                            $sql = $conn->query('select count(nomEquipement) as total from Equipement where etat like "Moyen"');
                            $res = $sql->fetch_assoc();
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
                <form action="formCour.php" method="POST">
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
                    <button type="submit" class="btn btn-primary" name="addCour">Ajouter le cours</button>
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

                        $res = $conn->query("SELECT * FROM Cour");

                        while ($ro = $res->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>{$ro['nomCour']}</td>
                                    <td>{$ro['categorie']}</td>
                                    <td>{$ro['dateCour']}</td>
                                    <td>{$ro['heure']}</td>
                                    <td>{$ro['durée']}</td>
                                    <td>{$ro['nbrMax']}</td>
                                    <td class='action-btns'>
                                        <a href='editCour.php?id={$ro['idCour']}' class='btn btn-warning btn-small'>✏️ Modifier</a>
                                        <a href='deleteCour.php?id={$ro['idCour']}' class='btn btn-danger btn-small' onclick='return confirm('Supprimer cet équipement?')'>🗑️ Supprimer</a>
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
                                include 'db.php';
                                $result = $conn->query("SELECT idCour, nomCour, dateCour, heure FROM Cour");
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['idCour']}'>{$row['nomCour']} - {$row['dateCour']} {$row['heure']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sélectionner un équipement *</label>
                        <select name="idEquipement" required>
                            <option value="">Choisir un équipement...</option>
                            <?php
                                $result = $conn->query("SELECT idEquipement, nomEquipement FROM Equipement WHERE etat='Disponible'");
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['idEquipement']}'>{$row['nomEquipement']}</option>";
                                }
                            ?>
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
                <form action="formEquipement.php" method="POST">
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
                                <option value="Bon">Bon</option>
                                <option value="Moyen">Moyen</option>
                                <option value="A Remplacer">A Remplacer</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="addEquipement">Ajouter l'équipement</button>
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
                        require "./database/db.php";

                        $res = $conn->query("SELECT * FROM Equipement");

                        while ($ro = $res->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>{$ro['nomEquipement']}</td>
                                    <td>{$ro['typeEquipement']}</td>
                                    <td>{$ro['qtsDispo']}</td>
                                    <td>{$ro['etat']}</td>
                                    <td class='action-btns'>
                                        <a href='editEquipement.php?id={$ro['idEquipement']}' class='btn btn-warning btn-small'>✏️ Modifier</a>
                                        <a href='deleteEquipement.php?id={$ro['idEquipement']}' class='btn btn-danger btn-small' onclick='return confirm('Supprimer cet équipement?')'>🗑️ Supprimer</a>
                                    </td>
                                </tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="./style/main.js"></script>
    </body>
</html>