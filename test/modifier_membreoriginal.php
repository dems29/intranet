<html>
<head>
    <title>Modifier Membre - Intranet</title>
    <style>
         body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0px;
            background: linear-gradient(blue, red);
            background-repeat: no-repeat;
            background-attachment: fixed;
        } 

        h1 {
            margin-bottom: 20px;
            color: white;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="checkbox"], input[type="file"],
        select {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 40%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Modifier Membre</h1>

    <div class="form-container">
        <?php
        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérifier si un ID de membre a été sélectionné
            if (isset($_POST['id'])) {
                // Récupérer l'ID du membre sélectionné
                $id = $_POST['id'];

                // Connexion à la base de données
                $conn = new mysqli("localhost", "root", "root", "intranet_pleyben");

                // Vérifier la connexion
                if ($conn->connect_error) {
                    die("Échec de la connexion à la base de données : " . $conn->connect_error);
                }

                // Récupérer les informations du membre à partir de la base de données
                $sql = "SELECT * FROM membres WHERE id = $id";
                $result = $conn->query($sql);

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $role = $row['role'];
                    $nom = $row['nom'];
                    $prenom = $row['prenom'];
                    $jourNaissance = $row['jour_naissance'];
                    $moisNaissance = $row['mois_naissance'];
                    $anneeNaissance = $row['annee_naissance'];
                    $lieux_naissance = $row['lieux_naissance'];
                    $poids = $row['poids'];
                    $allergies = $row['allergies'];
                    $numeroLicence = $row['numero_licence'];
                    $adresseMail = $row['adresse_mail'];
                    $adresse = $row['adresse'];
                    $numeroTelephone = $row['numero_telephone'];
                    $parents = $row['parents'];
                    $tenue_rouge = $row['tenue_rouge'];
                    $tenue_bleue = $row['tenue_bleue'];
                    $chaussons = $row['chaussons'];
                    $photoName = $row['photo'];

                   // Vérifier si le formulaire de modification a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom'])) {
    // Récupérer les valeurs des champs du formulaire
    $role = $_POST['role'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $jourNaissance = $_POST['jour_naissance'];
    $moisNaissance = $_POST['mois_naissance'];
    $anneeNaissance = $_POST['annee_naissance'];
    $lieux_naissance = $_POST['lieux_naissance'];
    $poids = $_POST['poids'];
    $allergies = $_POST['allergies'];
    $numeroLicence = $_POST['numero_licence'];
    $adresseMail = $_POST['adresse_mail'];
    $adresse = $_POST['adresse'];
    $numeroTelephone = $_POST['numero_telephone'];
    $parents = $_POST['parents'];
    $tenue_rouge = isset($_POST['tenue_rouge']) ? $_POST['tenue_rouge'] : 0;
    $tenue_bleue = isset($_POST['tenue_bleue']) ? $_POST['tenue_bleue'] : 0;
    $chaussons = isset($_POST['chaussons']) ? $_POST['chaussons'] : 0;
    $photoName = $_POST['photo'];

    // Mettre à jour le membre dans la base de données
    $updateSql = "UPDATE membres SET role='$role', nom='$nom', prenom='$prenom', jour_naissance='$jourNaissance', mois_naissance='$moisNaissance', annee_naissance='$anneeNaissance', lieux_naissance='$lieux_naissance', poids='$poids', allergies='$allergies', numero_licence='$numeroLicence', adresse_mail='$adresseMail', adresse='$adresse', numero_telephone='$numeroTelephone', parents='$parents', tenue_rouge='$tenue_rouge', tenue_bleue='$tenue_bleue', chaussons='$chaussons', photo='$photoName' WHERE id=$id";

    if ($conn->query($updateSql) === TRUE) {
        echo "Les modifications ont été enregistrées avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'enregistrement des modifications : " . $conn->error;
    }
}


                    // Afficher le formulaire de modification
                    echo '<form action="modifier_membre.php" method="post">';
                    echo '<input type="hidden" name="id" value="' . $id . '">';

                    echo '<label for="role">Rôle :</label>';
                    echo '<select name="role">';
                    echo '<option value="Entraineur">Entraîneur</option>';
                    echo '<option value="Bureau">Bureau</option>';
                    echo '<option value="Licencie">Licencié</option>';
                    echo '</select><br>';

                    echo '<label for="nom">Nom :</label>';
                    echo '<input type="text" name="nom" value="' . $nom . '"><br>';

                    echo '<label for="prenom">Prénom :</label>';
                    echo '<input type="text" name="prenom" value="' . $prenom . '"><br>';

                    echo '<label for="jour_naissance">Jour de naissance :</label>';
                    echo '<input type="text" name="jour_naissance" value="' . $jourNaissance . '"><br>';

                    echo '<label for="mois_naissance">Mois de naissance :</label>';
                    echo '<input type="text" name="mois_naissance" value="' . $moisNaissance . '"><br>';

                    echo '<label for="annee_naissance">Année de naissance :</label>';
                    echo '<input type="text" name="annee_naissance" value="' . $anneeNaissance . '"><br>';

                    echo '<label for="lieux_naissance">Lieu de naissance :</label>';
                    echo '<input type="text" name="lieux_naissance" value="' . $lieux_naissance . '"><br>';

                    echo '<label for="poids">Poids :</label>';
                    echo '<input type="text" name="poids" value="' . $poids . '"><br>';

                    echo '<label for="allergies">Allergies :</label>';
                    echo '<input type="text" name="allergies" value="' . $allergies . '"><br>';

                    echo '<label for="numero_licence">Numéro de licence :</label>';
                    echo '<input type="text" name="numero_licence" value="' . $numeroLicence . '"><br>';

                    echo '<label for="adresse_mail">Adresse e-mail :</label>';
                    echo '<input type="text" name="adresse_mail" value="' . $adresseMail . '"><br>';

                    echo '<label for="adresse">Adresse :</label>';
                    echo '<input type="text" name="adresse" value="' . $adresse . '"><br>';

                    echo '<label for="numero_telephone">Numéro de téléphone :</label>';
                    echo '<input type="text" name="numero_telephone" value="' . $numeroTelephone . '"><br>';

                    echo '<label for="parents">Nom et prénom des parents :</label>';
                    echo '<input type="text" name="parents" value="' . $parents . '"><br>';

                    echo '<label for="tenue_rouge">Tenue Rouge :</label>';
                    echo '<input type="checkbox" name="tenue_rouge" value="1" ' . ($tenue_rouge == 1 ? 'checked' : '') . '><br>';

                    echo '<label for="tenue_bleue">Tenue Bleue :</label>';
                    echo '<input type="checkbox" name="tenue_bleue" value="1" ' . ($tenue_bleue == 1 ? 'checked' : '') . '><br>';

                    echo '<label for="chaussons">Chaussons :</label>';
                    echo '<input type="checkbox" name="chaussons" value="1" ' . ($chaussons == 1 ? 'checked' : '') . '><br>';


                    echo '<label for="photo">Photo :</label>';
                    echo '<input type="file" name="photo"' . $photoName . '"><br>';

                    echo '<input type="submit" value="Enregistrer">';
                    echo '</form>';

                    // Fermer la connexion à la base de données
                    $conn->close();
                } else {
                    echo "Aucun membre trouvé avec cet ID.";
                }
            } else {
                echo "Aucun ID de membre spécifié.";
            }
        } else {
            // Afficher le formulaire de sélection du membre
            echo '<form action="modifier_membre.php" method="post">';
            echo '<label for="id">Sélectionner un membre :</label>';

            // Connexion à la base de données
            $conn = new mysqli("localhost", "root", "root", "intranet_pleyben");

            // Vérifier la connexion
            if ($conn->connect_error) {
                die("Échec de la connexion à la base de données : " . $conn->connect_error);
            }

            // Récupérer la liste des membres
            $sql = "SELECT id, nom, prenom FROM membres";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                echo '<select name="id">';
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['nom'] . ' ' . $row['prenom'] . '</option>';
                }
                echo '</select>';
                echo '<br>';
                echo '<input type="submit" value="Modifier">';
            } else {
                echo "Aucun membre trouvé dans la base de données.";
            }

            // Fermer la connexion à la base de données
            $conn->close();

            echo '</form>';
        }
        ?>
    </div>
</body>
</html>
