<?php

require_once "Connexion.php";
class DeconnexionUser extends Connexion
{
    public function __construct(){
        parent::__construct();
    }

    public function deconnexion($identifiant){

        $stmt = $this->dao->prepare("SELECT * FROM utilisateurs WHERE identifiant = :identifiant");
        $stmt->bindParam(":identifiant", $identifiant);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Mettre à jour la connexion
            $stmtConnecter = $this->dao->prepare("UPDATE utilisateurs SET connecter = 0 WHERE identifiant = :identifiant");
            $stmtConnecter->bindParam(":identifiant", $identifiant);
            $stmtConnecter->execute();

            return ["success" => true];
        }


}