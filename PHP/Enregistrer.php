<?php
require_once "Connexion.php"; // Inclusion de la connexion

class Enregistrer extends Connexion {

    public function __construct() {
        parent::__construct(); // Appelle le constructeur parent
    }

    public function enregistrerMess($auteur, $contenu) {
        try {
            $estampille = date("Y-m-d H:i:s"); // Format SQL standard
            $stmt = $this->dao->prepare("
                INSERT INTO messagerie (estampille_horaire, auteur, contenu) 
                VALUES (:estampille_horaire, :auteur, :contenu)
            ");

            // Sécurisation avec htmlspecialchars()
            $stmt->bindValue(':estampille_horaire', $estampille);
            $stmt->bindValue(':auteur', htmlspecialchars($auteur));
            $stmt->bindValue(':contenu', htmlspecialchars($contenu));

            $stmt->execute();

            return true; // Retourne true si l'insertion est réussie
        } catch (PDOException $e) {
            error_log("Erreur lors de l'enregistrement : " . $e->getMessage());
            return false; // Retourne false en cas d'échec
        }
    }
}
?>
