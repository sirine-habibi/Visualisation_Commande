<?php
// Vérifier si l'ID du commentaire est présent dans la requête POST
if (isset($_POST['id'])) {
    // Récupérer l'ID du commentaire à supprimer depuis la requête POST
    $id = $_POST['id'];

    // Connexion à la base de données
    $connexion = new PDO('mysql:host=127.0.0.1;dbname=pfe', 'root', '');

    // Préparer la requête de suppression du commentaire
    $sql = "DELETE FROM discussion WHERE id = :id";
    $requete = $connexion->prepare($sql);

    // Liage des paramètres et exécution de la requête
    $requete->bindParam(':id', $id, PDO::PARAM_INT);
    $requete->execute();

    // Fermer la connexion
    $connexion = null;

    // Retourner un statut de succès
    http_response_code(200);
    echo json_encode(["message" => "Le commentaire a été supprimé avec succès"]);
} else {
    // Retourner un statut d'erreur
    http_response_code(400);
    echo json_encode(["message" => "L'ID du commentaire n'a pas été fourni"]);
}
?>
