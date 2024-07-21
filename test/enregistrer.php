<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "root", "intranet_pleyben");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Fonction de nettoyage des entrées
function cleanInput($input) {
    $cleaned = trim($input);
    $cleaned = htmlspecialchars($cleaned);
    // Ajoute d'autres nettoyages si nécessaire
    return $cleaned;
}

// Récupérer les valeurs du formulaire et les nettoyer
$role = cleanInput($_POST["role"]);
$nom = cleanInput($_POST["nom"]);
$prenom = cleanInput($_POST["prenom"]);
$jour_naissance = cleanInput($_POST["jour_naissance"]);
$mois_naissance = cleanInput($_POST["mois_naissance"]);
$annee_naissance = cleanInput($_POST["annee_naissance"]);
$lieux_naissance = cleanInput($_POST["lieux_naissance"]);
$poids = cleanInput($_POST["poids"]);
$allergies = cleanInput($_POST["allergies"]);
$numero_licence = cleanInput($_POST["numero_licence"]);
$adresse_mail = cleanInput($_POST["adresse_mail"]);
$adresse = cleanInput($_POST["adresse"]);
$numero_telephone = cleanInput($_POST["numero_telephone"]);
$parents = cleanInput($_POST["parents"]);
$tenue_rouge = isset($_POST["tenue_rouge"]) ? 1 : 0;
$tenue_bleue = isset($_POST["tenue_bleue"]) ? 1 : 0;
$chaussons = isset($_POST["chaussons"]) ? 1 : 0;
$photoName = cleanInput($_FILES['photo']['name']);

// Vérifier si un fichier a été téléchargé
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    // Récupérer le nom du fichier téléchargé
    $photoName = $_FILES['photo']['name'];
    // Déplacer le fichier téléchargé vers le dossier de destination
    move_uploaded_file($_FILES['photo']['tmp_name'], 'photo/' . $photoName);
} else {
    // Si aucun fichier n'a été téléchargé, définir le nom de la photo comme une valeur par défaut
    $photoName = 'default.jpg';
}

// Formatage de la date de naissance
$dateNaissance = $annee_naissance . '-' . $mois_naissance . '-' . $jour_naissance;

// Préparer la requête SQL avec des paramètres liés
$sql = "INSERT INTO membres ( role, nom, prenom, jour_naissance, mois_naissance, annee_naissance, lieux_naissance, poids, allergies, numero_licence, adresse_mail, adresse, numero_telephone, parents, tenue_rouge, tenue_bleue, chaussons, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Erreur lors de la préparation de la requête : " . $conn->error);
}
$stmt->bind_param("sssssssisssssiiiis", $role, $nom, $prenom, $jour_naissance, $mois_naissance, $annee_naissance, $lieux_naissance, $poids, $allergies, $numero_licence, $adresse_mail, $adresse, $numero_telephone, $parents, $tenue_rouge, $tenue_bleue, $chaussons, $photoName);

if ($stmt->execute()) {
    // Redirection vers la page d'accueil
    header("Location: index.php");
    exit();
} else {
    echo "Erreur lors de l'enregistrement du membre : " . $stmt->error;
}

// Fermer la connexion à la base de données
$stmt->close();
$conn->close();
?>