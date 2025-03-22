<?php

require_once "Connexion.php";

class VerifyConnected extends Connexion
{

    public function __construct(){
        parent::__construct();
    }

    public function isConnected($identifiant)
    {
        $stmt = $this->dao->prepare("SELECT connecter from utilisateurs where identifiant = :identifiant");
        $stmt->bindValue(':identifiant', $identifiant);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère un tableau associatif

        return $result['connecter'] == 1;
    }

}