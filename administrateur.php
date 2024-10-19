<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord Bootstrap</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome icons -->
  <style>
    /* Contenu général */
    body {
      background-color: #f8f9fa;
    }

    .container {
      margin-top: 50px;
    }

    .dashboard-content {
      padding: 20px;
    }

    .dashboard-header {
      margin-bottom: 30px;
    }

    .card {
      margin-bottom: 20px;
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Barre latérale */
    .sidebar {
      background-color: #343a40;
      height: 100vh;
      padding: 20px;
      color: white;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px 0;
    }

    .sidebar a:hover {
      background-color: #0056b3;
      text-decoration: none;
    }

    /* Formulaire de recherche */
    .form-group {
      margin-bottom: 20px;
    }

    /* Tableau */
    .table-bordered,
    .table-striped {
      /* Styles spécifiques pour le tableau */
    }

    /* Nouveau style pour aligner les icônes d'action */
    .actions-cell {
      white-space: nowrap; /* Empêche le renvoi à la ligne */
    }

    /* Boutons */
    .btn {
      /* Styles pour les boutons */
    }
      /* Nouveaux styles pour le tableau de données */
 
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row justify-content-center"> <!-- Utilise justify-content-center pour centrer le contenu -->
    <!-- Sidebar -->
    <nav class="col-md-3 col-lg-2 d-md-block sidebar">
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

    <!-- Main content -->
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 dashboard-content">
      <div class="dashboard-header">
        <h2 class="h2">Tableau de données</h2>
        <div class="form-group">
          <input type="text" class="form-control" id="searchInput" placeholder="Rechercher...">
        </div>
      </div>

      <div class="container">
        <div class="row justify-content-center"> <!-- Utilise justify-content-center pour centrer le contenu -->
          <!-- Contenu principal -->
          <main role="main" class="col-md-12 px-md-4"> <!-- Utilise col-md-12 pour occuper toute la largeur sur les écrans moyens et grands -->
            
              <table class="table table-bordered table-striped ">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Numéro de série</th>
                    <th scope="col">Password</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody id="tableBody">
                  <?php
                    // Your PHP code to connect to the database and retrieve data
                    $connexion = new PDO('mysql:host=127.0.0.1;dbname=pfe', 'root', '');

                    $sql = "SELECT * FROM compte";
                    $resultat = $connexion->query($sql);

                    if ($resultat->rowCount() > 0) {
                      while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($ligne['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($ligne['prenom']) . "</td>";
                        echo "<td>" . htmlspecialchars($ligne['email']) . "</td>";

                        // Right-align phone number
                        echo "<td class='numeric'>" . htmlspecialchars($ligne['telephone']) . "</td>";

                        echo "<td class='truncate'>" . htmlspecialchars($ligne['numéro_de_série']) . "</td>";

                        // Display the password directly
                        echo "<td>" . htmlspecialchars($ligne['password']) . "</td>";

                        echo "<td class='actions-cell'>";
                        echo "<a href='modifier.php?id=" . $ligne['id'] . "' class='btn btn-primary btn-sm mr-1'><i class='fas fa-edit'></i></a>";
                        echo "<a href='#' onclick=\"confirmerSuppression('supprimer.php?id=" . $ligne['id'] . "')\" class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='7' class='text-center'>Aucune donnée trouvée dans la base de données.</td></tr>";
                    }

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


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  // Fonction de filtrage de la recherche
  document.getElementById('searchInput').addEventListener('keyup', function() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toLowerCase();
    table = document.querySelector('.table');
    tr = table.getElementsByTagName('tr');
  
    for (i = 1; i < tr.length; i++) {
      tr[i].style.display = 'none'; // Hide all rows initially
      
      // Check all table cells in the row
      td = tr[i].getElementsByTagName('td');
      for (j = 0; j < td.length; j++) {
        if (td[j]) {
          txtValue = td[j].textContent || td[j].innerText;
          if (txtValue.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = ''; // Show row if match found
            break;
          }
        }
      }
    }
  });
</script>
<script>
  // Fonction pour confirmer la suppression
  function confirmerSuppression(url) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet élément ?")) {
      window.location.href = url; // Redirection vers la page de suppression
    }
  }
</script>

</body>
</html>
