<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "Connexion.php";
require_once "InscriptionUtilisateurs.php";

$response = [];

if (isset($_POST['identifiant'], $_POST['pwd'], $_POST['pwd_confirm'])) {
    $identifiant = $_POST['identifiant'];
    $pwd = $_POST['pwd'];
    $pwd_confirm = $_POST['pwd_confirm'];

    try {
        $inscrire = new InscriptionUtilisateurs();
        $inscrire->inscrireUser($identifiant, $pwd, $pwd_confirm);

        $response = ["success" => true, "message" => "Inscription réalisée avec succès."];
    } catch (Exception $e) {
        $response = ["success" => false, "message" => "Erreur lors de l'inscription : " . $e->getMessage()];
    }
} else {
    $response = ["success" => false, "message" => "Données manquantes."];
}

echo json_encode($response);
exit;