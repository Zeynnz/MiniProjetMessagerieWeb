<?php


abstract class connexion {

    protected $dao;

    public function __construct(){
        $host = 'localhost'; // Hostname or IP
        $port = 3306;       // Default PostgreSQL port
        $dbname = 'messagerie'; // Your database name
        $user = 'uti';      // Database username
        $password = 'iutinfo'; // Database password

        try {
            // Create a new PDO instance
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
            $this->dao = new PDO($dsn, $user, $password);

            // Set error mode to exception
            $this->dao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            // Handle connection errors
            echo "Database connection failed: " . $e->getMessage();
        }
    }




}