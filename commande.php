<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer une commande de lunettes smart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            color: #555;
        }
        input, textarea {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            border: none;
            background: #5cb85c;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Passer une commande de lunettes smart</h2>
        <form action="commande.php" method="post">
            <label for="nom_client">Nom:</label>
            <input type="text" id="nom_client" name="nom_client" required>

            <label for="email_client">Email:</label>
            <input type="email" id="email_client" name="email_client" required>

            <label for="adresse_client">Adresse:</label>
            <textarea id="adresse_client" name="adresse_client" required></textarea>

            <label for="telephone_client">Numéro de téléphone:</label>
            <input type="tel" id="telephone_client" name="telephone_client" required>

            <label for="quantite">Quantité:</label>
            <input type="number" id="quantite" name="quantite" required min="1">

            <button type="submit" name="submit">Passer la commande</button>
        </form>
    </div>
    <?php
if (isset($_POST['submit'])) {
    // Connexion à la base de données
    try {
        $connexion = new PDO('mysql:host=127.0.0.1;dbname=pfe', 'root', '');
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['nom_client']);
    $email = htmlspecialchars($_POST['email_client']);
    $adresse = htmlspecialchars($_POST['adresse_client']);
    $telephone = htmlspecialchars($_POST['telephone_client']);
    $quantite = intval($_POST['quantite']);

    // Insérer les données dans la base de données
    $sql = "INSERT INTO commande (nom_client, email_client, adresse_client, telephone_client, quantite) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connexion->prepare($sql);
    $stmt->execute([$nom, $email, $adresse, $telephone, $quantite]);

    // Rediriger vers la page de succès
    header("Location: success.php");
    exit();
}
?>

</body>
</html>
