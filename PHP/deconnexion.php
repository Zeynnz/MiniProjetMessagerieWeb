<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


require_once "Connexion.php";
    require_once "DeconnexionUser.php";

    $deconnexion = new DeconnexionUser();
    $deconnexion->deconnexion($_SESSION['user_id']);

    session_destroy();
    echo json_encode(["success" => true]);
    exit;
?>
