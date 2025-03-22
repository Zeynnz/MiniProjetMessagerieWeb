<?php
    header('Content-Type: text/plain');
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require_once 'Connexion.php';
    require_once 'Recuperer.php';

    try {
        $recuperer = new Recuperer();
        $messages = $recuperer->RecupererMess();
        echo json_encode($messages);
    } catch (Exception $e) {
        echo "Erreur de récupération : " . $e->getMessage();
    }
