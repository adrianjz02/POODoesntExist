<?php

namespace App\Database;

use PDO;
use PDOException;

class DataBaseConnection {
    private $serveur = "localhost";
    private $nomBdd = "POODoesntExist";
    private $utilisateur = "root";
    private $motDePasse = "";
    private $connexion;

    public function openConnection() {
        if ($this->connexion == null) {
            try {
                $this->connexion = new PDO("mysql:host=$this->serveur;dbname=$this->nomBdd", $this->utilisateur, $this->motDePasse);

                $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                throw new PDOException("Erreur de connexion : " . $e->getMessage());
            }
        }
        return $this->connexion;
    }

    public function closeConnection() {
        $this->connexion = null;
    }
}
