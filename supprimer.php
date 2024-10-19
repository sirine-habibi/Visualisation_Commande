<?php
// Vérifier si un identifiant a été transmis
if(isset($_GET['id']) && !empty($_GET['id'])){
    // Récupérer l'identifiant de l'entrée à supprimer
    $id = $_GET['id'];

    // Connexion à la base de données
    $connexion = new PDO('mysql:host=127.0.0.1;dbname=pfe', 'root', '');

    // Préparer la requête de suppression
    $sql = "DELETE FROM compte WHERE id = :id";

    // Préparer et exécuter la requête
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Rediriger vers la page d'accueil après la suppression
    header('Location: administrateur.php');
    exit();
} else {
    // Rediriger vers la page d'accueil si aucun identifiant n'est spécifié
    header('Location: index.php');
    exit();
}
?>
