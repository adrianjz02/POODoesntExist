<?php

namespace App\Database;

class CommandeRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Enregistre une commande dans la base de données
    public function save(Commande $commande) {
        if ($commande->getId() === null) {
            $stmt = $this->pdo->prepare("INSERT INTO commandes (numero_commande, utilisateur_id) VALUES (?, ?)");
            $stmt->execute([$commande->getNumeroCommande(), $commande->getUtilisateurId()]);
        }
    }

    // Récupère toutes les commandes de la base de données
    public function findAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM commandes");
        $stmt->execute();
        $commandes = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $commande = new Commande($row['id'], $row['numero_commande'], $row['utilisateur_id']);
            $commandes[] = $commande;
        }
        return $commandes;
    }

    // Récupère une commande par son identifiant
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM commandes WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            return new Commande($row['id'], $row['numero_commande'], $row['utilisateur_id']);
        }
        return null;
    }

    // Met à jour une commande dans la base de données
    public function update(Commande $commande) {
        $stmt = $this->pdo->prepare("UPDATE commandes SET numero_commande = ?, utilisateur_id = ? WHERE id = ?");
        $stmt->execute([$commande->getNumeroCommande(), $commande->getUtilisateurId(), $commande->getId()]);
    }

    // Supprime une commande de la base de données
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM commandes WHERE id = ?");
        $stmt->execute([$id]);
    }

    // Récupère toutes les commandes avec les détails de l'utilisateur associé
    public function findAllWithUserDetails() {
        $stmt = $this->pdo->prepare("SELECT commandes.id, commandes.numero_commande, utilisateurs.nom, utilisateurs.prenom FROM commandes INNER JOIN utilisateurs ON commandes.utilisateur_id = utilisateurs.id");
        $stmt->execute();
        $resultats = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $resultats[] = $row;
        }
        return $resultats;
    }
    
}

?>