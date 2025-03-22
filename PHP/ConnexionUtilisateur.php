<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class ConnexionUtilisateur extends Connexion
{
    public function verifyUser($identifiant, $pwd) {
        $stmt = $this->dao->prepare("SELECT * FROM utilisateurs WHERE identifiant = :identifiant");
        $stmt->bindParam(":identifiant", $identifiant);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user && password_verify($pwd, $user["mdp"])) {
            $_SESSION["user_id"] = $user["identifiant"];

            // Mettre à jour la connexion
            $stmtConnecter = $this->dao->prepare("UPDATE utilisateurs SET connecter = 1 WHERE identifiant = :identifiant");
            $stmtConnecter->bindParam(":identifiant", $identifiant);
            $stmtConnecter->execute();

            return ["success" => true];
        } else {
            return ["success" => false, "message" => "Identifiant ou mot de passe incorrect"];
        }
    }

}