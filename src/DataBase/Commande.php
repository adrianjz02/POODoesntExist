<?php

namespace App\Database;

class Commande
{
    public $id;
    public $numeroCommande;
    public $utilisateurId;

    public function __construct($id = null, $numeroCommande = null, $utilisateurId = null)
    {
        $this->id = $id;
        $this->numeroCommande = $numeroCommande;
        $this->utilisateurId = $utilisateurId;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNumeroCommande()
    {
        return $this->numeroCommande;
    }

    public function getUtilisateurId()
    {
        return $this->utilisateurId;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNumeroCommande($numeroCommande)
    {
        $this->numeroCommande = $numeroCommande;
    }

    public function setUtilisateurId($utilisateurId)
    {
        $this->utilisateurId = $utilisateurId;
    }
}
?>