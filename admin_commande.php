<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord Bootstrap</title>
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
        <h2 class="h2">Tableau de commande</h2>
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
                  <th scope="col">Adresse Client</th>
                  <th scope="col">Téléphone Client</th>
                  <th scope="col">Quantité</th>
                  <th scope="col">Date de Commande</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody id="tableBody">
                <?php
                  $connexion = new PDO('mysql:host=127.0.0.1;dbname=pfe', 'root', '');
                  $sql = "SELECT nom_client, email_client, adresse_client, telephone_client, quantite, date_commande, etat 
                          FROM commande 
                          ORDER BY date_commande DESC";
                  $resultat = $connexion->query($sql);

                  if ($resultat->rowCount() > 0) {
                    while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($ligne['nom_client']) . "</td>";
                      echo "<td>" . htmlspecialchars($ligne['email_client']) . "</td>";
                      echo "<td>" . htmlspecialchars($ligne['adresse_client']) . "</td>";
                      echo "<td>" . htmlspecialchars($ligne['telephone_client']) . "</td>";
                      echo "<td>" . htmlspecialchars($ligne['quantite']) . "</td>";
                      echo "<td>" . htmlspecialchars($ligne['date_commande']) . "</td>";
                      echo "<td class='actions-cell'>";
                      if ($ligne['etat'] === 'Terminé') {
                        echo "<a href='#' class='btn btn-success btn-sm'><i class='fas fa-check-circle'></i> Terminé</a>";
                      } else {
                        echo "<a href='#' class='btn btn-warning btn-sm btn-en-attente'><i class='fas fa-hourglass-half'></i> En attente</a>";
                      }
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
  document.getElementById('searchInput').addEventListener('keyup', function() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toLowerCase();
    table = document.querySelector('.table');
    tr = table.getElementsByTagName('tr');
  
    for (i = 1; i < tr.length; i++) {
      tr[i].style.display = 'none';
      td = tr[i].getElementsByTagName('td');
      for (j = 0; j < td.length; j++) {
        if (td[j]) {
          txtValue = td[j].textContent || td[j].innerText;
          if (txtValue.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = '';
            break;
          }
        }
      }
    }
  });

  document.addEventListener('DOMContentLoaded', function() {
    var boutonsEnAttente = document.querySelectorAll('.btn-en-attente');

    boutonsEnAttente.forEach(function(bouton) {
        bouton.addEventListener('click', function(event) {
            event.preventDefault();
            var row = bouton.closest('tr');
            var nomClient = row.cells[0].textContent;
            var emailClient = row.cells[1].textContent;
            var nouvelEtat = "Terminé";
            var dateChangement = new Date().toISOString().split('T')[0];

            var data = {
                nom_client: nomClient,
                email_client: emailClient,
                nouvel_etat: nouvelEtat,
                date_changement: dateChangement
            };

            fetch('mettre_a_jour_etat.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(function(response) {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Erreur lors de la mise à jour de l\'état');
                }
            }).then(function(result) {
                console.log(result.message);

                fetch('enregistrer_etat.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }).then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Erreur lors de l\'enregistrement des données');
                    }
                }).then(function(result) {
                    console.log(result.message);

                    bouton.innerHTML = '<i class="fas fa-check-circle"></i> Terminé';
                    bouton.classList.remove('btn-warning');
                    bouton.classList.add('btn-success');
                }).catch(function(error) {
                    console.error('Erreur:', error);
                });
            }).catch(function(error) {
                console.error('Erreur:', error);
            });
        });
    });
});

</script>

</body>
</html>
