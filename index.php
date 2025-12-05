<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GymPro - Gestion de Salle de Sport</title>
    <link rel="stylesheet" href="/style/style.css">
</head>
<body>
    <!-- Sidebar -->     
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h1>GymPro</h1>
        </div>
        <nav class="sidebar-nav">
            <a href="#" class="nav-item active" data-page="dashboard">
                <span class="icon">📊</span>
                <span>Dashboard</span>
            </a>
            <a href="#" class="nav-item" data-page="courses">
                <span class="icon">📅</span>
                <span>Cours</span>
            </a>
            <a href="#" class="nav-item" data-page="equipments">
                <span class="icon">🏋️</span>
                <span>Équipements</span>
            </a>
            <a href="#" class="nav-item" data-page="association">
                <span class="icon">🔗</span>
                <span>Association</span>
            </a>
        </nav>
        <div class="sidebar-footer">
            <a href="#" class="nav-item">
                <span class="icon">🚪</span>
                <span onclick="window.location.href = 'login.php'" >Déconnexion</span>
                
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="header">
            <button class="menu-toggle" id="menuToggle">☰</button>
            <h2 id="pageTitle">Dashboard</h2>
            <div class="header-actions">
                <button class="btn btn-secondary">Exporter</button>
                <div class="user-info">
                    <span>Admin</span>
                </div>
            </div>
        </header>

        <!-- Dashboard Page -->
        <div class="page" id="dashboard-page">
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">📅</div>
                    <div class="stat-details">
                        <h3>Total Cours</h3>
                        <p class="stat-number">
                            <?php 
                                include "./database/db.php";
                                $res = $conn->query('select count(nomCour) as total from Cour;');
                                if(!$res){
                                    die("data crashed: " . $conn->error);
                                }
                                $row = $res->fetch_assoc();
                                echo "$row[total]";
                            ?>
                        </p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">🏋️</div>
                    <div class="stat-details">
                        <h3>Total Équipements</h3>
                        <p class="stat-number">
                            <?php 
                                include "./database/db.php";
                                $res = $conn->query('select count(nomEquipement) as total from Equipement;');
                                if(!$res){
                                    die("data crashed: " . $conn->error);
                                }
                                $row = $res->fetch_assoc();
                                echo "$row[total]";
                            ?>
                        </p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">✅</div>
                    <div class="stat-details">
                        <h3>Disponible</h3>
                        <p class="stat-number">
                            <?php 
                                include "./database/db.php";
                                $res = $conn->query('select count(etat) as total from Equipement where etat like "Disponible";');
                                if(!$res){
                                    die("data crashed: " . $conn->error);
                                }
                                $row = $res->fetch_assoc();
                                echo "$row[total]";
                            ?>
                        </p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">⚠️</div>
                    <div class="stat-details">
                        <h3>En maintenance</h3>
                        <p class="stat-number">
                            <?php 
                                include "./database/db.php";
                                $res = $conn->query('select count(etat) as total from Equipement where etat like "En maintenance";');
                                if(!$res){
                                    die("data crashed: " . $conn->error);
                                }
                                $row = $res->fetch_assoc();
                                echo "$row[total]";
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            

            <div class="charts-grid">
                <div class="chart-card">
                    <h3>Répartition des Cours</h3>
                    <div class="chart-placeholder">
                        <div class="bar" style="height: 80%;">
                            <span>Yoga<br>12</span>
                        </div>
                        <div class="bar" style="height: 60%;">
                            <span>Musculation<br>8</span>
                        </div>
                        <div class="bar" style="height: 40%;">
                            <span>Cardio<br>4</span>
                        </div>
                    </div>
                </div>
                <div class="chart-card">
                    <h3>Répartition des Équipements</h3>
                    <div class="chart-placeholder">
                        <div class="bar" style="height: 70%;">
                            <span>Cardio<br>45</span>
                        </div>
                        <div class="bar" style="height: 90%;">
                            <span>Musculation<br>80</span>
                        </div>
                        <div class="bar" style="height: 50%;">
                            <span>Yoga<br>31</span>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>

        
        <!-- Courses Page -->
        <div class="page" id="courses-page" style="display: none;">
            <div class="page-header">
                <h3>Liste des Cours</h3>
                <div class="page-actions">
                    <input type="text" class="search-input" placeholder="Rechercher...">
                    <select class="filter-select">
                        <option>Tous les types</option>
                        <option>Yoga</option>
                        <option>Musculation</option>
                        <option>Cardio</option>
                    </select>
                    <button class="btn btn-primary" onclick="openModal('add-course')">+ Ajouter un cours</button>
                </div>
            </div>

            
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Durée</th>
                        <th>Max Participants</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   <?php          
                        include './database/db.php';

                        $sql = 'select * from Cour';
                        $res = $conn->query($sql);
                        if(!$res){
                            die("data crashed: " . $conn->error);
                        }

                        foreach($res as $row){
                            echo "
                            <tr>
                                <td>$row[nomCour]</td>
                                <td>$row[categorie]</td>
                                <td>$row[dateCour]</td>
                                <td>$row[heure]</td>
                                <td>$row[durée] Min</td>
                                <td>$row[nbrMax]</td>
                                <td>
                                    <a class='btn-icon' href='edit.php?id=$row[idCour]' title='Modifier'>✏️</a>
                                    <a class='btn-icon' href='delete.php?id=$row[idCour]' title='Supprimer'>🗑️</a>
                                </td>
                            </tr>
                            ";
                        }


                    ?>
                </tbody>
            </table>
        </div>

        <!-- Equipments Page -->
        <div class="page" id="equipments-page" style="display: none;">
            <div class="page-header">
                <h3>Liste des Équipements</h3>
                <div class="page-actions">
                    <input type="text" class="search-input" placeholder="Rechercher...">
                    <select class="filter-select">
                        <option>Tous les types</option>
                        <option>Cardio</option>
                        <option>Musculation</option>
                        <option>Yoga</option>
                    </select>
                    <button class="btn btn-primary" onclick="openModal('add-equipment')">+ Ajouter un équipement</button>
                </div>
            </div>

            <table class="data-table">
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
                        include './database/db.php';

                        $sql = 'select * from Equipement';
                        $res = $conn->query($sql);
                        if(!$res){
                            die("data crashed: " . $conn->error);
                        }

                        foreach($res as $row){
                            echo "
                            <tr>
                                <td>$row[nomEquipement]</td>
                                <td>$row[typeEquipement]</td>
                                <td>$row[qtsDispo]</td>
                                <td>$row[etat]</td>
                                <td>
                                    <a class='btn-icon' href='editEquipement.php?id=$row[idEquipement]' title='Modifier'>✏️</a>
                                    <a class='btn-icon' href='deleteEquipement.php?id=$row[idEquipement]' title='Supprimer'>🗑️</a>                                
                                </td>
                    </tr>
                            ";
                        }

                    ?>
                </tbody>
            </table>
        </div>

        <!-- Association Page -->
        <div class="page" id="association-page" style="display: none;">
            <div class="page-header">
                <h3>Association Cours - Équipements</h3>
                <button class="btn btn-primary" onclick="openModal('add-association')">+ Créer une association</button>
            </div>

            <div class="association-grid">
                <?php 
                include './database/db.php';

                        $sql = 'select * from cour_equipement ';
                        $res = $conn->query($sql);
                        if(!$res){
                            die("data crashed: " . $conn->error);
                        }
                echo"
                <div class='association-card'>
                    <h4>Musculation Avancée</h4>
                    <p class='course-info'>05/12/2024 - 10:00</p>
                    <div class='equipment-list'>
                        <span class='equipment-tag'>Haltères 5kg <button class='remove-tag'>×</button></span>
                        <span class='equipment-tag'>Banc de musculation <button class='remove-tag'>×</button></span>
                    </div>
                    <button class='btn btn-secondary btn-small' onclick='openModal('manage-association')'>Gérer</button>
                </div>"
                ?>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal" id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Ajouter un cours</h3>
                <button class="modal-close" onclick="closeModal()">×</button>
            </div>
            <div class="modal-body">
                <form id="modalForm" action="create.php" method="post">
                    <!-- Form fields will be populated by JavaScript -->
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Catégorie</label>
                        <select class="form-control" required>
                            <option value="">Sélectionner...</option>
                            <option>Yoga</option>
                            <option>Musculation</option>
                            <option>Cardio</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Heure</label>
                            <input type="time" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Durée (min)</label>
                            <input type="number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Max Participants</label>
                            <input type="number" class="form-control" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal()">Annuler</button>
                <button class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>

    <script src="/style/main.js"></script>
</body>
</html>