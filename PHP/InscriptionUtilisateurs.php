<?php

require_once "Connexion.php";
class InscriptionUtilisateurs extends Connexion
{
    public function __construct()
    {
        parent::__construct(); // Appelle le constructeur parent
    }

    public function inscrireUser($identifiant, $pwd, $pwd_confim)
    {

        if ($pwd !== $pwd_confim) {
            echo json_encode(["success" => false, "message" => "Les mots de passe ne correspondent pas"]);
            exit;
        }

        $stmt = $this->dao->prepare("SELECT idUser FROM utilisateurs WHERE identifiant = :identifiant");
        $stmt->bindParam(":identifiant", $identifiant);
        $stmt->execute();
        if ($stmt->fetch()) {
            echo json_encode(["success" => false, "message" => "Identifiant déjà utilisé"]);
            exit;
        }


        $stmt = $this->dao->prepare("
                INSERT INTO utilisateurs (identifiant, mdp) 
                VALUES (:identifiant, :mdp)
            ");

        $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);


        // Sécurisation avec htmlspecialchars()
        $stmt->bindValue(':identifiant', $identifiant);
        $stmt->bindValue(':mdp', $hashed_pwd);

        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
            exit;
        } else {
            echo json_encode(["success" => false, "message" => "Erreur lors de l'inscription"]);
            exit;
        }

    }
}