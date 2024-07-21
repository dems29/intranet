<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un palmarès</title>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0px;
            background: linear-gradient(blue, red);
            background-repeat: no-repeat;
            background-attachment: fixed;
        } 

        .add-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0088cc;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .add-button:hover {
            background-color: #006699;
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
    </style>
</head>
<body>
<h3>Ajouter un passage de grade</h3>

<?php
// Vérifier si l'ID membre est fourni dans la requête GET ou POST
if (!empty($_GET['id'])) {
    $idMembre = $_GET['id'];
} elseif (!empty($_POST['id_membre'])) {
    $idMembre = $_POST['id_membre'];
} else {
    // Si l'ID membre n'est pas fourni dans la requête GET ou POST, afficher un message d'erreur
    die("Erreur : ID membre non fourni");
}
?>

<form action="ajouter_grade.php" method="POST">
    <input type="hidden" name="id_membre" value="<?php echo $idMembre; ?>">
    <div class="form-group">
        <label for="ceinture">Ceinture :</label>
        <input type="text" name="ceinture" required>
    </div>
    <div class="form-group">
        <label for="date_passage">Date de passage :</label>
        <input type="date" name="date_passage" required>
    </div>
    <div class="form-group">
        <label for="document">Document :</label>
        <input type="file" name="document">
    </div>
    <input type="submit" value="Ajouter" class="submit-button">
</form>

<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_membre'])) {
    $idMembre = $_POST['id_membre'];
    $ceinture = $_POST['ceinture'];
    $datePassage = $_POST['date_passage'];
    $document = $_POST['document'];

    // Connexion à la base de données
    $conn = new mysqli("localhost", "root", "root", "intranet_pleyben");

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }

    // Préparer la requête SQL pour ajouter un passage de grade
    $sqlAjoutGrade = "INSERT INTO historique_grade (id_membre, ceinture, date_passage, document) VALUES ('$idMembre', '$ceinture', '$datePassage', '$document')";

    // Exécuter la requête SQL
    if ($conn->query($sqlAjoutGrade) === TRUE) {
        echo '<p>Passage de grade ajouté avec succès.</p>';
        // Rediriger vers une autre page
        header("Location: fiche_membre.php?id=" . $idMembre);
        exit();
    } else {
        echo '<p>Erreur lors de l\'ajout du passage de grade : ' . $conn->error . '</p>';
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
</body>
</html>