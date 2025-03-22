<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "Connexion.php";
require_once "ConnexionUtilisateur.php";

if (isset($_POST['identifiant']) && isset($_POST['pwd'])) {
    $identifiant = $_POST['identifiant'];
    $pwd = $_POST['pwd'];

    try {
        $connecter = new ConnexionUtilisateur();
        $result = $connecter->verifyUser($identifiant, $pwd);

        echo json_encode($result); // Maintenant on envoie bien la réponse
        exit;
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Erreur lors de la connexion : " . $e->getMessage()]);
        exit;
    }
} else {
    echo json_encode(["success" => false, "message" => "Données manquantes."]);
    exit;
}
?>
