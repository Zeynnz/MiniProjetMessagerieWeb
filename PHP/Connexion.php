<?php

abstract class Connexion {
    protected $dao;

    public function __construct() {
        $host = 'mysql-zeynn.alwaysdata.net';
        $dbname = 'zeynn_messagerie';
        $user = 'zeynn_uti';
        $password = 'iutinfo';

        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
            $this->dao = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Active le mode exception
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Fetch en tableau associatif
            ]);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
}
?>
