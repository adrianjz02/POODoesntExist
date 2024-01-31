<?php

namespace App\Database;

class Commande
{
    /**
     * Identifiant de la commande.
     *
     * @var int|null
     */
    public $id;

    /**
     * Numéro de la commande.
     *
     * @var string|null
     */
    public $numeroCommande;

    /**
     * Identifiant de l'utilisateur associé à la commande.
     *
     * @var int|null
     */
    public $utilisateurId;

    /**
     * Constructeur de la classe Commande.
     *
     * @param int|null    $id              Identifiant de la commande.
     * @param string|null $numeroCommande  Numéro de la commande.
     * @param int|null    $utilisateurId   Identifiant de l'utilisateur associé à la commande.
     */
    public function __construct($id = null, $numeroCommande = null, $utilisateurId = null)
    {
        $this->id = $id;
        $this->numeroCommande = $numeroCommande;
        $this->utilisateurId = $utilisateurId;
    }

    // Getters

    /**
     * Obtient l'identifiant de la commande.
     *
     * @return int|null Identifiant de la commande.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtient le numéro de la commande.
     *
     * @return string|null Numéro de la commande.
     */
    public function getNumeroCommande()
    {
        return $this->numeroCommande;
    }

    /**
     * Obtient l'identifiant de l'utilisateur associé à la commande.
     *
     * @return int|null Identifiant de l'utilisateur associé à la commande.
     */
    public function getUtilisateurId()
    {
        return $this->utilisateurId;
    }

    // Setters

    /**
     * Définit l'identifiant de la commande.
     *
     * @param int|null $id Identifiant de la commande.
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Définit le numéro de la commande.
     *
     * @param string|null $numeroCommande Numéro de la commande.
     */
    public function setNumeroCommande($numeroCommande)
    {
        $this->numeroCommande = $numeroCommande;
    }

    /**
     * Définit l'identifiant de l'utilisateur associé à la commande.
     *
     * @param int|null $utilisateurId Identifiant de l'utilisateur associé à la commande.
     */
    public function setUtilisateurId($utilisateurId)
    {
        $this->utilisateurId = $utilisateurId;
    }
}
?>