<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['nom_client']) && isset($data['email_client']) && isset($data['nouvel_etat'])) {
    $nom_client = htmlspecialchars($data['nom_client']);
    $email_client = htmlspecialchars($data['email_client']);
    $nouvel_etat = htmlspecialchars($data['nouvel_etat']);

    try {
        $connexion = new PDO('mysql:host=127.0.0.1;dbname=pfe', 'root', '');
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE commande SET etat = ? WHERE nom_client = ? AND email_client = ?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$nouvel_etat, $nom_client, $email_client]);

        echo json_encode(['message' => 'État mis à jour avec succès']);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Données manquantes']);
}
?>
