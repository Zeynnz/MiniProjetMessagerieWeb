<?php
require_once "Connexion.php"; // Inclusion de la connexion

class Recuperer extends Connexion {

    public function __construct() {
        parent::__construct(); // Appelle le constructeur parent
    }

    public function RecupererMess($limit = 10) {
        try {
            $stmt = $this->dao->prepare("
                SELECT auteur, contenu
                FROM messagerie 
                ORDER BY estampille_horaire DESC 
                LIMIT :limit
            ");
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT); // Cast en int pour éviter les injections SQL
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère un tableau associatif
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des messages : " . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }
}
?>
