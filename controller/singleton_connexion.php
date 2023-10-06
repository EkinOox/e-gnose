<?php

class Database
{
    static private $instantiate = null;

    //private $host = "telchak.o2switch.net";
    //private $dbname = "engk9490_e-gnose";
    //private $user = "engk9490";
    //private $pass = "p]bbxAH@7cNy";
    private $connexionbdd;
    private $host = "telchak.o2switch.net";
    private $dbname = "engk9490_e-gnose";
    private $user = "engk9490";
    private $pass = "^cd#Jj%7Eg&b";

    // Paramètre de connexion à la base
    private function __construct()
    {
        try {
            $this->connexionbdd = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->connexionbdd->exec("set names utf8mb4");
        } catch (PDOException $e) {
            echo '<div class="error-bdd">' . "Erreur de connexion à la base de données !" . '</div>';
        }
    }

    public function __clone()
    {
        trigger_error("Le clonage n'est pas autorisé", E_USER_ERROR);
    }
    
    // Permet d'instancier la connexion à la BDD
    public static function getInstance()
    {
        //Si pas instancié alors on l'instancie
        if (!isset(self::$instantiate)) {
            self::$instantiate = new Database();
        }
        return self::$instantiate;
    }
    public function getConnexion(){
        return $this->connexionbdd;
    }
}
// Vérifie si une connexion existe déjà
$database = Database::getInstance();
// connexion
$db = $database->getConnexion();