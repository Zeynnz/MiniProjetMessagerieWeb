<?php

class enregistrer extends connexion {

    function __construct() {
        parent::__construct();
    }
    public function enregistrerMess($estampille_horaire, $auteur,$contenu){
        $stmt = $this->dao->prepare("INSERT INTO message(estampille_horaire,auteur,contenu) 
            VALUES(:estampille_horaire,:auteur,:contenu) ");
        $stmt->bindParam(':estampille_horaire',$estampille_horaire);
        $stmt->bindParam(':auteur',$auteur);
        $stmt->bindParam(':contenu',$contenu);
        $stmt->execute();
    }

}