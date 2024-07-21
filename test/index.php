<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="logo.png">
    <title>Intranet - Celtic Contact</title>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0px;
            background: linear-gradient(blue, red);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 30px;
            margin-top: 0px;
            color: white;
        }

        .member-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px;
            margin-bottom: 20px;
            margin-top: 20px;
            margin-left: 10px;
            display: inline-block;
            width: 300px;
            text-align: center;
            position: relative;
        }

        .member-card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .member-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }

        .member-card p {
            font-size: 14px;
            margin-bottom: 5px;
            color: #666;
        }

        .add-member-button {
            font-size: 20px;
            width: 200px;
            margin-right: 30px;
            border-radius: 100rem;
            background-color: #0088cc;
            color: #fff;
            text-decoration: none;
            background-image: linear-gradient(90deg, #ED1C24 0%, #ED1C24 30%, #183576 80%, #183576 100%);
            background-size: 200% auto;
            transition: background-position 0.3s;
            text-align: center;
            line-height: 300%;
            }

            .add-member-button:hover {
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

        .arrow {
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-left: 10px solid black;
            display: inline-block;
            margin-left: 10px;
            transition: transform 0.5s ease;
        }

        .arrow:hover {
            transform: rotate(90deg);
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
            margin-right: 5px;
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

        form {
  display: flex;
  align-items: center;
  margin-left: 40px;
  margin-top: 10px;
  align-items: flex-start;

}

input[type="text"] {
  width: 200px;
  padding: 0px 10px 0px 10px;
  border: none;
  border-bottom: 2px solid white;
  background-color: transparent;
  font-size: 16px;
  outline: none;
  margin-top: 10px;
  color: white;
}

input[type="submit"] {
  width: 40px;
  height: 40px;
  padding: 0;
  border: none;
  background-color: transparent;
  cursor: pointer;
  outline: none;
  position: relative;
}

input[type="submit"]::before,
input[type="submit"]::after {
  content: "";
  display: block;
  position: absolute;
}

input[type="submit"]::before {
  width: 20px;
  height: 20px;
  border: 2px solid white;
  border-radius: 50%;
  left: 10px;
  top: 10px;
}

input[type="submit"]::after {
  width: 6px;
  height: 6px;
  border: 2px solid white;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
  left: 18px;
  top: 18px;
}
    </style>
</head>
<body>
    <header>
        <h1>Intranet - Celtic Contact</h1>
        <form method="GET" action="index.php">
  <input type="text" name="search" id="searchInput" placeholder="Rechercher" onfocus="clearSearchInput()" onblur="restoreSearchInput()">
  <input type="submit" value="">
</form>

<script>
  function clearSearchInput() {
    var searchInput = document.getElementById("searchInput");
    if (searchInput.value === "Rechercher") {
      searchInput.value = "";
    }
    searchInput.style.color = "white";
  }

  function restoreSearchInput() {
    var searchInput = document.getElementById("searchInput");
    if (searchInput.value === "") {
      searchInput.value = "Rechercher";
      searchInput.style.color = "white";
    }
  }
</script>
        <a class="add-member-button" href="inscription.php">Ajouter un membre</a>
    </header>
    <main>
        
        <?php
        // Connexion à la base de données
        $conn = new mysqli("localhost", "root", "root", "intranet_pleyben");

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Échec de la connexion à la base de données : " . $conn->connect_error);
        }

        // Récupérer la recherche si elle a été soumise
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

        // Préparer la requête SQL avec la recherche
        $sql = "SELECT * FROM membres WHERE nom LIKE '%$searchTerm%' OR prenom LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        // Afficher les membres sous forme de cartes
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="member-card">';
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
                echo '</div>';
                echo '<img src="photo/' . $row['photo'] . '" alt="Photo du membre">';
                echo '<h3>' . $row['nom'] . ' ' . $row['prenom'] . '</h3>';
                echo '<p><strong>Date de naissance :</strong> ' . $row['jour_naissance'] . '/' . $row['mois_naissance'] . '/' . $row['annee_naissance'] . '</p>';
                echo '<p><strong>Poids :</strong> ' . $row['poids'] . '</p>';
                echo '<p><strong>Numéro de licence :</strong> ' . $row['numero_licence'] . '</p>';

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
                            }
                        } else {
                            echo "<p>Aucun membre trouvé.</p>";
                        }

                        // Fermer la connexion à la base de données
                        $conn->close();
        ?>
    </main>
</body>
</html>