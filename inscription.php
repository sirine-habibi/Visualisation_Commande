<?php
session_start();
$connexion = new PDO('mysql:host=127.0.0.1;dbname=pfe','root','');
if (isset($_POST["valider"])){
    if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['telephone']) AND !empty($_POST['numéro_de_série'])){
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['password']);
        $telephone = htmlspecialchars($_POST['telephone']);
        $numero_serie = htmlspecialchars($_POST['numéro_de_série']);
        
        $currentYear = date('y');
        $currentMonth = date('m');
        
        if (strlen($_POST['password']) < 7){
            $message = "Votre mot de passe est trop court.";
        } elseif (strlen($_POST['nom']) > 50 || strlen($_POST['prenom']) > 50){
            $message = "Votre nom ou prénom est trop long";
        } elseif (!preg_match('/^\d{2}\d{2}\d{3}$/', $numero_serie) || substr($numero_serie, 0, 2) != $currentYear || substr($numero_serie, 2, 2) != $currentMonth) {
            $message = "Le numéro de série doit être au format 'les deux derniers chiffres de l'année, les deux chiffres du mois suivis de trois chiffres' (ex. '230501' pour mai 2023).";
        } else {
            $testmail = $connexion->prepare("SELECT * FROM compte WHERE email = ?");
            $testmail->execute(array($email));

            $controlmail = $testmail->rowCount();
            if ($controlmail == 0){
                $insertion = $connexion->prepare("INSERT INTO compte(nom, prenom, email, password, telephone, numéro_de_série) VALUES(?, ?, ?, ?, ?, ?)");
                $insertion->execute(array($nom, $prenom, $email, $mdp, $telephone, $numero_serie));
                $message = "Votre compte a bien été créé";
            } else {
                $message = "Désolé mais cette adresse a déjà un compte.";
            }
        }
    } else {
        $message = "Remplissez tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Inscription</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/bootstrap.css'>
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
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-6 form-container">
                <h2 class="text-center mb-4"><i class="fas fa-user-plus"></i> Inscription</h2>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="nom" class="form-label"><i class="fas fa-user"></i> Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control form-control-lg" placeholder="Entrez votre nom">
                    </div>
                    <div class="mb-3">
                        <label for="prenom" class="form-label"><i class="fas fa-user"></i> Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control form-control-lg" placeholder="Entrez votre prénom">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Entrez votre email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="fas fa-lock"></i> Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Entrez votre mot de passe">
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label"><i class="fas fa-phone"></i> Téléphone</label>
                        <input type="text" id="telephone" name="telephone" class="form-control form-control-lg" placeholder="Entrez votre numéro de téléphone">
                    </div>
                    <div class="mb-3">
                        <label for="numéro_de_série" class="form-label"><i class="fas fa-check-circle"></i> Numéro de série</label>
                        <input type="text" id="numéro_de_série" name="numéro_de_série" class="form-control form-control-lg" placeholder="Entrez votre numéro de série">
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="valider" class="btn btn-custom btn-lg"><i class="fas fa-user-plus"></i> S’inscrire</button>
                        <?php if (isset($message)): ?>
                            <p id="message" class="text-danger mt-3"><?php echo $message; ?></p>
                        <?php endif; ?>
                        <p class="text-center text-muted mt-3">
                            <i style="color:red">
                                <?php
                                if (isset($message)){
                                    //echo $message."<br />";
                                }
                                ?>
                            </i>
                            En cliquant sur S’inscrire, vous acceptez nos <a href="#"> Conditions générales</a>, notre <a href=""> Politique de confidentialité</a> et notre <a href="#"> Politique d’utilisation</a> des cookies.
                        </p>
                        <p class="text-center">
                            Avez-vous déjà un compte ? <a href="connexion.php" class="link-flesh">Connexion</a>
                        </p>
                    </div>
                </form>
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
