<?php

class Authentification extends connexion
{

    public function __construct(){
        parent::__construct();
    }

    public function connexion($identifiant,$mdp){
        $stmt = $this->dao->prepare("Select * from utilisateur where identifiant = :identifiant AND mdp = :mdp");
        $stmt->execute(array('identifiant' => $identifiant, 'mdp' => $mdp));

        if ($stmt->rowCount() == 1) {
            return true;
        }
        return false;
    }

    public function alreadyIn($identifiant){
        $stmt = $this->dao->prepare("Select * from utilisateur where identifiant = :identifiant");
        $stmt->execute(array('identifiant' => $identifiant));

        if ($stmt->rowCount() == 1) {
            return true;
        }
        return false;
    }

    public function inscription($identifiant,$mdp){
        $stmt = $this->dao->prepare("Insert into utilisateur values (:identifiant,:mdp)");
        $stmt-> execute(array('identifiant' => $identifiant, 'mdp' => $mdp));

        if ($stmt->rowCount() == 1) {
            return true;
        }
        return false;

    }

}