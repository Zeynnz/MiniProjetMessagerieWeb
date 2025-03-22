<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "Connexion.php";
require_once "Enregistrer.php";

// Vérifie si les données sont envoyées
if (isset($_POST['pseudo']) && isset($_POST['contenu'])) {
    $auteur = $_POST['pseudo'];
    $contenu = $_POST['contenu'];

    try {
        $enregistre = new Enregistrer();
        $enregistre->enregistrerMess($auteur, $contenu);

        // Réponse JSON en cas de succès
        echo json_encode(["success" => true, "message" => "Message enregistré avec succès."]);
    } catch (Exception $e) {
        // Réponse JSON en cas d'erreur
        echo json_encode(["success" => false, "message" => "Erreur lors de l'enregistrement : " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données manquantes."]);
}
?>
