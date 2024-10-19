<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['nom_client']) && isset($data['email_client']) && isset($data['nouvel_etat']) && isset($data['date_changement'])) {
    $nom_client = htmlspecialchars($data['nom_client']);
    $email_client = htmlspecialchars($data['email_client']);
    $nouvel_etat = htmlspecialchars($data['nouvel_etat']);
    $date_changement = htmlspecialchars($data['date_changement']);

    try {
        $connexion = new PDO('mysql:host=127.0.0.1;dbname=pfe', 'root', '');
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO historique_etat (nom_client, email_client, etat, date_changement) VALUES (?, ?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$nom_client, $email_client, $nouvel_etat, $date_changement]);

        echo json_encode(['message' => 'Historique enregistré avec succès']);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Données manquantes']);
}
?>
