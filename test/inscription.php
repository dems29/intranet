<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="logo.png">
    <title>Intranet - Formulaire d'inscription</title>
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
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
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
            margin-left: 33%;
        }
    </style>
</head>
<body>
    <h1>Intranet - Formulaire d'inscription</h1>

    <div class="form-container">
        <form method="post" action="enregistrer.php" enctype="multipart/form-data">
            <div class="form-group">
            <label for="role">Role :</label>
            <select id="role" name="role" required>
                <option value="Entraineur">Entraineur</option>
                <option value="Bureau">Bureau</option>
                <option value="Licencié">Licencié</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="jour_naissance">Jour de naissance :</label>
                <input type="text" id="jour_naissance" name="jour_naissance" required>
            </div>
            <div class="form-group">
                <label for="mois_naissance">Mois de naissance :</label>
                <input type="text" id="mois_naissance" name="mois_naissance" required>
            </div>
            <div class="form-group">
                <label for="annee_naissance">Année de naissance :</label>
                <input type="text" id="annee_naissance" name="annee_naissance" required>
            </div>
            <div class="form-group">
                <label for="lieux_naissance">Lieux de naissance :</label>
                <input type="text" id="lieux_naissance" name="lieux_naissance" required>
            </div>
            <div class="form-group">
                <label for="poids">Poids :</label>
                <input type="text" id="poids" name="poids">
            </div>
            <div class="form-group">
                <label for="allergies">Allergies :</label>
                <input type="text" id="allergies" name="allergies">
            </div>
            <div class="form-group">
                <label for="numero_licence">Numéro de licence :</label>
                <input type="text" id="numero_licence" name="numero_licence" required>
            </div>
            <div class="form-group">
                <label for="adresse_mail">Adresse e-mail :</label>
                <input type="text" id="adresse_mail" name="adresse_mail" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" required>
            </div>
            <div class="form-group">
                <label for="numero_telephone">Numéro de téléphone :</label>
                <input type="text" id="numero_telephone" name="numero_telephone" required>
            </div>
            <div class="form-group">
                <label for="parents">Nom et prénom des parents :</label>
                <input type="text" id="parents" name="parents">
            </div>
            <div class="form-group">
                <label for="tenue_rouge">Tenue rouge :</label>
                <input type="checkbox" id="tenue_rouge" name="tenue_rouge">
            </div>
            <div class="form-group">
                <label for="tenue_bleue">Tenue bleue :</label>
                <input type="checkbox" id="tenue_bleue" name="tenue_bleue">
            </div>
            <div class="form-group">
                <label for="chaussons">Chaussons :</label>
                <input type="checkbox" id="chaussons" name="chaussons">
            </div>
            <div class="form-group">
                <label for="photo">Photo :</label>
                <input type="file" id="photo" name="photo">
            </div>
            <div class="form-group">
                <input type="submit" value="Soumettre">
            </div>
        </form>
    </div>
</body>
</html>
