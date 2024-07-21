<!DOCTYPE html>
<html>
<head>
    <title>Fiche de grade</title>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0px;
            background: linear-gradient(red, blue);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 30px;
            margin-top: 0px;
            color: white;
        }

        header {
            display: flex;
            justify-content: space-between;
            margin: 0px;
        }

        .grade-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            width: 500px;
            margin-left: 30%;
            text-align: center;
            margin-top: 40px;
        }

        .grade-card h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .grade-card p {
            font-size: 16px;
            margin-bottom: 5px;
            color: #666;
        }

        .view-all-button {
  display: block;
  width: 200px;
  margin: 30px 33%;
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

.back-button , button {
            display: block;
            margin: 10px 30px 0px 0px;
            text-align: right;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.5s ease;
            font-size: 20px;
        }

        .back-button:hover {
            color: black;
        }
    </style>
</head>
<body>
<a class="back-button" href="index.php">Accueil</a>
    <?php
    // Vérifier si l'ID du membre est fourni dans la requête URL
    if (isset($_GET['id'])) {
        $idMembre = $_GET['id'];

        // Connexion à la base de données
        $conn = new mysqli("localhost", "root", "root", "intranet_pleyben");

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Échec de la connexion à la base de données : " . $conn->connect_error);
        }

        // Récupérer le membre
        $sqlMembre = "SELECT * FROM membres WHERE id = $idMembre";
        $resultMembre = $conn->query($sqlMembre);

        if ($resultMembre->num_rows == 1) {
            $membre = $resultMembre->fetch_assoc();

            // Récupérer l'historique de grade du membre
            $sqlHistoriqueGrade = "SELECT * FROM historique_grade WHERE id_membre = $idMembre";
            $resultHistoriqueGrade = $conn->query($sqlHistoriqueGrade);

            echo '<div class="grade-card">';
            echo '<h3>Fiche de grade de ' . $membre['nom'] . ' ' . $membre['prenom'] . '</h3>';

            if ($resultHistoriqueGrade->num_rows > 0) {
                while ($grade = $resultHistoriqueGrade->fetch_assoc()) {
                    echo '<p>Ceinture : ' . $grade['ceinture'] . '</p>';
                    echo '<p>Date de passage : ' . $grade['date_passage'] . '</p>';
                    echo '<p>Document : <a href="' . $grade['document'] . '">Voir le document</a></p>';
                }
            } else {
                echo '<p>Aucun historique de grade trouvé pour ce membre.</p>';
            }

            echo '<a class="view-all-button" href="ajouter_grade.php?id=' . $idMembre . '">Ajouter un passage de grade</a>';
            echo '</div>';
        } else {
            echo '<p>Membre introuvable.</p>';
        }

        // Fermer la connexion à la base de données
        $conn->close();
    } else {
        echo '<p>Aucun membre sélectionné.</p>';
    }
    ?>
</body>
</html>