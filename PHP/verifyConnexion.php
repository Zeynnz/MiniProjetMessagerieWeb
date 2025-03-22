<?php
    header('Content-Type: text/plain');
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require_once 'Connexion.php';
    require_once 'VerifyConnected.php';

    if($_POST['identifiant']){
        $identifiant = $_POST['identifiant'];

        $verify = new VerifyConnected();

        if ($verify->isConnected($identifiant)) {
            echo json_encode(["success" => true, "message" => "Utilisateur connecté"]);
        } else {
            echo json_encode(["success" => false, "message" => "Utilisateur non connecté"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Identifiant manquant"]);
    }