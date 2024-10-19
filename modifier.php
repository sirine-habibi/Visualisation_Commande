<?php
// modifier.php
include 'conn.php';

// Vérifier si l'identifiant est passé en paramètre d'URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Récupérer les données du compte à modifier
    $sql = "SELECT * FROM compte WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $compte = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$compte) {
        header("Location: administrateur.php");
        exit;
    }
} else {
    echo "ID de compte manquant";
    exit;
}

// Mettre à jour les données du compte
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $num_serie = htmlspecialchars($_POST['num_serie']);
    $password = htmlspecialchars($_POST['password']);

    // Requête de mise à jour
    $sql = "UPDATE compte SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, numéro_de_série = :num_serie, password = :password WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':num_serie', $num_serie);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: administrateur.php");
    } else {
        echo "Erreur lors de la mise à jour du compte";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le compte</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="text-center mt-4">Modifier le compte</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($compte['nom']); ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($compte['prenom']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($compte['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($compte['telephone']); ?>" required>
        </div>
        <div class="form-group">
            <label for="num_serie">Numéro de série</label>
            <input type="text" class="form-control" id="num_serie" name="num_serie" value="<?php echo htmlspecialchars($compte['numéro_de_série']); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($compte['password']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="administrateur.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
