<?php
session_start();
// Informations de connexion à la base de données
$serveur = "127.0.0.1"; // ou l'adresse IP du serveur
$utilisateur = "root";
$motdepasse = "";
$basededonnees = "pfe";

// Connexion à la base de données
try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$basededonnees", $utilisateur, $motdepasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}

// Vérification de la soumission du formulaire
if (isset($_POST['valider'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = sha1($_POST['password']);
        
        // Vérification dans la table "compte"
        $req_compte = $connexion->prepare("SELECT * FROM compte WHERE email = ? AND password = ?");
        $req_compte->execute(array($email, $password));
        $cpt_compte = $req_compte->rowCount();

        // Vérification des identifiants admin statiques
        $adminEmail = 'admin@example.com';
        $adminPassword = sha1('adminpassword');

        if ($email === $adminEmail && $password === $adminPassword) {
            $_SESSION['username'] = 'Admin';
            $_SESSION['email'] = $adminEmail;
            $_SESSION['loggedin'] = true;
            header("Location: administrateur.php");
            exit();
        } elseif ($cpt_compte == 1) {
            $user = $req_compte->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $user['prenom'] . ' ' . $user['nom']; // Utiliser nom et prénom
            $_SESSION['email'] = $user['email'];
            $_SESSION['loggedin'] = true;
            header("Location: observateur.php");
            exit();
        } else {
            $message = "Désolé, nous ne trouvons pas ce compte.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Connexion et inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/all.min.css">
    <style>
        /* Styles personnalisés */
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .form-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: #ffffff;
        }
        .btn-custom:hover,
        .btn-custom:focus {
            background-color: #45a049;
            border-color: #45a049;
            color: #ffffff;
        }
        .btn-flesh {
            background-color: #ff3e3e;
            color: #ffffff;
        }
        .link-flesh {
            color: #ff3e3e;
        }
        .link-flesh:hover {
            text-decoration: none;
            color: #ff1a1a;
        }
        .form-control-lg {
            font-size: 1.25rem;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-6 form-container">
                <h2 class="text-center mb-4"><i class="fas fa-sign-in-alt"></i> Connexion</h2>

                <form method="POST" action="">
                    <div class="mb-4">
                        <label for="email" class="form-label"><i class="fas fa-at"></i> Adresse e-mail</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Entrez votre adresse e-mail">
                    </div>
                
                    <div class="mb-4">
                        <label for="password" class="form-label"><i class="fas fa-lock"></i> Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Entrez votre mot de passe">
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="valider" class="btn btn-custom btn-lg"><i class="fas fa-sign-in-alt"></i> Se connecter</button>
                        <?php if (isset($message)): ?>
                            <p id="message" class="text-danger mt-3"><?php echo $message; ?></p>
                        <?php endif; ?>
                        <p class="text-center mt-3">Vous n'avez pas de compte ? <a href="inscription.php">Inscription</a></p>
                    </div>
                </form>
                <!-- Lien de retour -->
                <p class="text-center mt-3"><a href="index.php" class="link-flesh"><i class="fas fa-arrow-left"></i> Retour</a></p>
            </div>
        </div>
    </div>
    
    <script src='js/bootstrap.js'></script>
    <script>
        // Faire disparaître le message après 5 secondes
        setTimeout(function() {
            var messageElement = document.getElementById('message');
            if (messageElement) {
                messageElement.style.display = 'none';
            }
        }, 5000); // 5000 millisecondes = 5 secondes
    </script>
</body>
</html>
