<?php
// Connexion à la base de données
$connexion = new PDO('mysql:host=127.0.0.1;dbname=pfe', 'root', '');

// Requête SQL pour récupérer les chats des utilisateurs
$sql = "SELECT * FROM discussion";
$resultat = $connexion->query($sql);

// Fermeture de la connexion
//$connexion = null; // Ne fermez pas la connexion ici

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chats des utilisateurs</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Ajout de Font Awesome pour les icônes -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* Style personnalisé pour les boutons */
    .btn-retour {
      color: #343a40; /* Couleur de l'icône et du texte */
      background-color: transparent; /* Fond transparent */
      border: none; /* Pas de bordure */
    }
    .btn-retour:hover {
      color: #dc3545; /* Couleur de survol de l'icône */
    }
    .btn-supprimer {
      color: #fff;
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .btn-supprimer:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }
    .chat-item {
      margin-bottom: 20px;
      padding: 15px;
      background-color: #343a40;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .chat-item h5 {
      margin-bottom: 5px;
      color: #17a2b8; /* Couleur du nom d'utilisateur */
    }
    .chat-item p {
      margin-bottom: 10px;
      color: #fff; /* Couleur du texte du message */
    }
    .chat-item small {
      color: #6c757d; /* Couleur du texte de la date */
    }
    .container {
      padding-top: 20px;
      padding-bottom: 20px;
    }
    .card {
      border: none;
      background-color: transparent;
    }
    .card-header {
      background-color: transparent;
      border-bottom: none;
    }
    .card-title {
      color: #343a40; /* Couleur du titre de la carte */
    }
    body {
      background-color: #f8f9fa; /* Couleur de fond de la page */
      color: #343a40; /* Couleur du texte principal */
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h2 class="card-title text-center">Chats des utilisateurs</h2>
          <a href="#" onclick="window.history.back();" class="btn btn-retour mr-3"><i class="fas fa-arrow-left"></i> Retour</a>
        </div>
        <div class="card-body">
          <?php
          // Parcourir les résultats de la requête et afficher les chats des utilisateurs
          while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="chat-item">
              <h5><?php echo htmlspecialchars($ligne['student']); ?></h5>
              <p><?php echo htmlspecialchars($ligne['post']); ?></p>
              <small><?php echo htmlspecialchars($ligne['date']); ?></small>
              <button class="btn btn-supprimer btn-sm float-right" onclick="supprimerCommentaire(<?php echo $ligne['id']; ?>)">
                <i class="fas fa-trash"></i> Supprimer
              </button>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Ajout de Font Awesome pour les icônes -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

<script>
  function supprimerCommentaire(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce commentaire ?")) {
      // Envoyer une requête de suppression au serveur
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "supprimer_commentaire.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          // Rafraîchir la page après la suppression
          location.reload();
        }
      };
      xhr.send("id=" + id);
    }
  }
</script>

</body>
</html>
