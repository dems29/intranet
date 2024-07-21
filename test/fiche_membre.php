<!DOCTYPE html>
<html>
<head>
    <title>Intranet - Fiche membre</title>
    <link rel="icon" href="logo.png">
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0px;
            background: linear-gradient(red, blue);
        }

        h1 {
            font-size: 32px;
            margin-bottom: 30px;
            margin-top: 0px;
            color: white;
        }

        header{
            display: flex;
            justify-content: space-between;
            margin: 0px;
        }

        .member-folder {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: inline-block;
            width: 500px;
            margin-left: 30%;
        }
        .member-info {
            text-align: center;
            margin-top: 20px;
        }

        .member-info h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .member-info p {
            font-size: 16px;
            margin-bottom: 5px;
            color: #666;
        }

        .member-info strong {
            font-weight: bold;
            color: #333;
        }

        .back-button , button {
            display: block;
            margin: 10px 0px 0px 0px;
            text-align: center;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.5s ease;
            font-size: 20px;
        }

        button{
            background: rgba(0,0,0,0);
            border: none;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 20px;
            padding: 0px 20px 0px 20px; 
            margin-top: 10px;
            cursor: pointer;
        }
        button:hover{
            color: black;
        }

        .back-button:hover {
            color: black;
        }

        .nav{
            display: flex;
        }

        .member-palmares {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            width: 500px;
            margin-left: 30%;
            text-align: center;
        }

        .member-palmares h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .palmares-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .palmares-list li {
            font-size: 16px;
            margin-bottom: 5px;
            color: #666;
        }

        .view-all-button {
  display: block;
  width: 200px;
  margin: 10px 33%;
  text-align: center;
  border-radius: 100rem;
  background-color: #0088cc;
  color: #fff;
  text-decoration: none;
  background-image: linear-gradient(90deg, #ED1C24 0%, #ED1C24 30%, #183576 80%, #183576 100%);
  background-size: 200% auto;
  transition: background-position 0.3s;
}

.view-all-button:hover {
  background-position: right center;
  animation: degradeAnime 4s linear infinite;
}

@keyframes degradeAnime {
  0% {
    background-position: left center;
  }
  100% {
    background-position: right center;
  }
}

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .submit-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        .color-indicators {
            position: absolute;
            top: 10;
            left: 10;
            display: flex;
        }

        .color-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .tenue-rouge {
            background-color: red;
        }

        .tenue-bleue {
            background-color: blue;
        }

        .chaussons {
            background-color: black;
        }
    </style>
</head>
<body>
    <header>
        <h1>Intranet - Fiche membre</h1>
        <div class="nav">
            <a class="back-button" href="index.php">Accueil</a>
            <?php
            // Vérifier si un ID de membre est passé en paramètre
            if (isset($_GET['id'])) {
                // Récupérer l'ID du membre depuis le paramètre de l'URL
                $id = $_GET['id'];
                ?>
                <form action="modifier_membre.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit">Modifier</button>
                </form>
            <?php } ?>
        </div>
    </header>
    <?php
    // Vérifier si un ID de membre est passé en paramètre
    if (isset($_GET['id'])) {
        // Connexion à la base de données
        $conn = new mysqli("localhost", "root", "root", "intranet_pleyben");

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Échec de la connexion à la base de données : " . $conn->connect_error);
        }

        // Récupérer l'ID du membre depuis le paramètre de l'URL
        $id = $_GET['id'];

        // Échapper les données de l'ID pour éviter les injections SQL
        $id = $conn->real_escape_string($id);

        // Récupérer les informations du membre à partir de la base de données
        $sql = "SELECT * FROM membres WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $nomMembre = $row['nom'] . ' ' . $row['prenom'];

            // Afficher les informations du membre
            echo '<div class="member-folder">';
            echo '<div class="member-info">';
            echo '<div class="color-indicators">';
                        if ($row['tenue_rouge'] == 1) {
                            echo '<span class="color-indicator tenue-rouge"></span>';
                        }
                        if ($row['tenue_bleue'] == 1) {
                            echo '<span class="color-indicator tenue-bleue"></span>';
                        }
                        if ($row['chaussons'] == 1) {
                            echo '<span class="color-indicator chaussons"></span>';
                        }
                        echo'</div>';
            // Afficher la photo du membre
            echo '<img src="photo/' . $row['photo'] . '" alt="Photo du membre" style="width: 200px; height: 200px; object-fit: cover;border-radius: 50%; margin-bottom: 10px;">';
            echo '<h3>' . $row['nom'] . ' ' . $row['prenom'] . '</h3>';
            echo '<p><strong>Role :</strong> ' . $row['role'] . '</p>';
            echo '<p><strong>Date de naissance :</strong> ' . $row['jour_naissance'] . '/' . $row['mois_naissance'] . '/' . $row['annee_naissance'] . '</p>';
            echo '<p><strong>Lieu de naissance :</strong> ' . $row['lieux_naissance'] . '</p>';
            echo '<p><strong>Poids :</strong> ' . $row['poids'] . '</p>';
            echo '<p><strong>Allergies :</strong> ' . $row['allergies'] . '</p>';
            echo '<p><strong>Numéro de licence :</strong> ' . $row['numero_licence'] . '</p>';
            echo '<p><strong>Adresse :</strong> ' . $row['adresse'] . '</p>';
            echo '<p><strong>Adresse e-mail :</strong> ' . $row['adresse_mail'] . '</p>';
            echo '<p><strong>Numéro de téléphone :</strong> ' . $row['numero_telephone'] . '</p>';
            echo '<p><strong>Nom et prénom des parents :</strong> ' . $row['parents'] . '</p>';
            // Récupérer l'année de naissance depuis la base de données
            $anneeNaissance = $row['annee_naissance']; 
            // Assurez-vous que la colonne 'annee_naissance' correspond à votre structure de base de données

            // Calculer l'année actuelle
            $anneeActuelle = date('Y');

            // Calculer l'âge en soustrayant l'année de naissance de l'année actuelle
            $age = $anneeActuelle - $anneeNaissance;

            // Définir les catégories d'âge avec leurs bornes
            $categoriesAge = [
                'Poussin A' => [5, 6],
                'Poussin B' => [7,8],
                'Poussin C' => [9,10],
                'Benjamin' => [11, 12],
                'Minime' => [13, 14],
                'Cadet' => [15, 16],
                'Junior' => [17, 18],
                'Espoir' => [19, 20],
                'Senior' => [21, 34],
                'Master A' => [35, 39],
                'Master B' => [40,44],
                'Master C' => [45,49],
                'Master D' => [50,54],
                'Master E' => [55,59],
                'Master F' => [60,64],
                'Master G' => [65,120],
            ];

            // Parcourir les catégories d'âge et déterminer dans quelle catégorie se trouve l'âge
            $categorie = 'Inconnu';
            foreach ($categoriesAge as $nomCategorie => $bornes) {
                $borneMin = $bornes[0];
                $borneMax = $bornes[1];
                
                if ($age >= $borneMin && $age <= $borneMax) {
                    $categorie = $nomCategorie;
                    break;
                }
            }

            // Afficher la catégorie d'âge dans la fiche membre
            echo '<p><strong>Catégorie d\'âge :</strong> ' . $categorie . '</p>';
                        echo '<a href="fiche_membre.php?id=' . $row['id'] . '"><div class="arrow"></div>
                        </a>'; // Ajout du lien vers la fiche du membre
                        echo '</div>';
            echo '</div>'; // Fermer la div .member-info
            echo '</div>'; // Fermer la div .member-folder

            echo '<div class="member-folder">';
            echo '<div class="member-info">';
            // Récupérer les résultats du palmarès du membre
            $sqlPalmares = "SELECT * FROM palmares WHERE id_membre = '$id' ORDER BY annee DESC LIMIT 3";
            $resultPalmares = $conn->query($sqlPalmares);

            echo '<h3>Palmarès</h3>';
            echo '<ul class="palmares-list">';
            if ($resultPalmares && $resultPalmares->num_rows > 0) {
                while ($rowPalmares = $resultPalmares->fetch_assoc()) {
                    echo '<li>' . $rowPalmares['competition'] . ' - ' . $rowPalmares['resultat'] . ' (' . $rowPalmares['annee'] . ')</li>';
                }
            } else {
                echo '<li>Aucun résultat de palmarès trouvé.</li>';
            }
            echo '</ul>';
            echo '<a class="view-all-button" href="palmares.php?id=' . $id . '">Voir tout le palmarès</a>';
            echo '</div>'; // Fermer la div .member-info
            echo '</div>'; // Fermer la div .member-folder
            echo '<div class="member-folder">';
            echo '<div class="member-info">';

            // Récupérer le dernier passage de grade du membre
            $sqlDernierGrade = "SELECT * FROM historique_grade WHERE id_membre = '$id' ORDER BY date_passage DESC LIMIT 1";
            $resultDernierGrade = $conn->query($sqlDernierGrade);

            echo '<h3>Dernier passage de grade</h3>';
            if ($resultDernierGrade && $resultDernierGrade->num_rows > 0) {
                $rowDernierGrade = $resultDernierGrade->fetch_assoc();
                echo '<div class="grade-card">';
                echo '<p><strong>Ceinture :</strong> ' . $rowDernierGrade['ceinture'] . '</p>';
                echo '<p><strong>Date de passage :</strong> ' . $rowDernierGrade['date_passage'] . '</p>';
                echo '</div>';
            } else {
                echo '<p>Aucun passage de grade trouvé.</p>';
            }
            echo '<a class="view-all-button" href="historique_grade.php?id=' . $id . '">Voir tous les passages de grade</a>';
            echo '</div>'; // Fermer la div .member-info
            echo '</div>'; // Fermer la div .member-folder

            echo '<div class="member-folder">';
            echo '<div class="member-info">';

            // Récupérer la dernière formation/stage du membre
            $sqlDernierFormationStage = "SELECT * FROM formations_stages WHERE id_membre = '$id' ORDER BY annee DESC LIMIT 1";
            $resultDernierFormationStage = $conn->query($sqlDernierFormationStage);

            echo '<h3>Dernier stage/formation</h3>';
            if ($resultDernierFormationStage && $resultDernierFormationStage->num_rows > 0) {
                $rowDernierFormationStage = $resultDernierFormationStage->fetch_assoc();
                echo '<div class="formation-stage-card">';
                echo '<p><strong>Stage/Formation :</strong> ' . $rowDernierFormationStage['formation_stage'] . '</p>';
                echo '<p><strong>Lieux :</strong> ' . $rowDernierFormationStage['lieux'] . '</p>';
                echo '<p><strong>Année :</strong> ' . $rowDernierFormationStage['annee'] . '</p>';
                echo '</div>';
            } else {
                echo '<p>Aucun stage/formation trouvé.</p>';
            }
            echo '<a class="view-all-button" href="formations_stages.php?id=' . $id . '">Voir tous les stages / formations</a>';
            echo '</div>'; // Fermer la div .member-info
            echo '</div>'; // Fermer la div .member-folder


        } else {
            echo "<p>Aucun membre trouvé avec cet ID.</p>";
        }

        // Fermer la connexion à la base de données
        $conn->close();
    }else {
        echo "<p>Aucun ID de membre spécifié.</p>";
    }
    ?>
</body>
</html>