<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historique des Commandes</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body { background-color: #f8f9fa; }
    .container { margin-top: 50px; }
    .dashboard-content { padding: 20px; }
    .dashboard-header { margin-bottom: 30px; }
    .card { margin-bottom: 20px; border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    .sidebar { background-color: #343a40; height: 100vh; padding: 20px; color: white; }
    .sidebar a { color: white; text-decoration: none; display: block; padding: 10px 0; }
    .sidebar a:hover { background-color: #0056b3; text-decoration: none; }
    .form-group { margin-bottom: 20px; }
    .actions-cell { white-space: nowrap; }
    .fixed-sidebar { position: fixed; top: 0; left: 0; bottom: 0; z-index: 1000; overflow-y: auto; }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row justify-content-center">
    <nav class="col-md-3 col-lg-2 d-md-block sidebar fixed-sidebar">
      <div class="sidebar-sticky">
        <h4 class="text-center">Tableau de Bord</h4>
        <ul class="nav flex-column">
          <li class="nav-item"><a class="nav-link active" href="#"><i class="fas fa-home"></i> Accueil</a></li>
          <li class="nav-item"><a class="nav-link" href="administrateur.php"><i class="fas fa-table"></i> Tableau de données</a></li>
          <li class="nav-item"><a class="nav-link" href="admin_commande.php"><i class="fas fa-shopping-cart"></i> Commande</a></li>
          <li class="nav-item"><a class="nav-link" href="historique.php"><i class="fas fa-history"></i> Historique de commande</a></li>
          <li class="nav-item"><a class="nav-link" href="chat_utilisateur.php"><i class="fas fa-envelope"></i> Messages</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 dashboard-content">
      <div class="dashboard-header">
        <h2 class="h2">Historique des Commandes</h2>
        <div class="form-group">
          <input type="text" class="form-control" id="searchInput" placeholder="Rechercher...">
        </div>
      </div>

      <div class="container">
        <div class="row justify-content-center">
          <main role="main" class="col-md-12 px-md-4">
            <table class="table table-bordered table-striped">
              <thead class="thead-dark">
              <tr>
                  <th scope="col">Nom Client</th>
                  <th scope="col">Email Client</th>
                  <th scope="col">Nouvel État</th>
                  <th scope="col">Date de Changement</th>
               </tr>
              </thead>
              <tbody id="tableBody">
              <?php
        // Définir le fuseau horaire pour la Tunisie
        date_default_timezone_set('Africa/Tunis');

        // Connexion à la base de données
        $connexion = new PDO('mysql:host=127.0.0.1;dbname=pfe', 'root', '');

        // Sélectionner les données de la table historique_etat
        $sql = "SELECT nom_client, email_client, etat AS nouvel_etat, date_changement FROM historique_etat ORDER BY date_changement DESC";
        $resultat = $connexion->query($sql);

        if ($resultat->rowCount() > 0) {
          while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($ligne['nom_client']) . "</td>";
            echo "<td>" . htmlspecialchars($ligne['email_client']) . "</td>";
            echo "<td>" . htmlspecialchars($ligne['nouvel_etat']) . "</td>";
            echo "<td>" . htmlspecialchars(date('Y-m-d H:i:s', strtotime($ligne['date_changement']))) . "</td>";

            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='4' class='text-center'>Aucune donnée trouvée dans la base de données.</td></tr>";
        }
         // Fermer la connexion
        $connexion = null;
      ?>
              </tbody>
            </table>
          </main>
        </div>
      </div>
    </main>
    </div>
</div>
</body>
</html>