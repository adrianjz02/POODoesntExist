<?php

namespace App\Database;

class UserRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Enregistre un utilisateur dans la base de données
    public function save(User $user)
    {
        if ($user->getId() === null) {
            $stmt = $this->pdo->prepare("INSERT INTO utilisateurs (nom, mail, ville, age) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user->getName(), $user->getEmail(), $user->getCity(), $user->getAge()]);
        }
    }

    // Récupère tous les utilisateurs de la base de données
    public function findAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs");
        $stmt->execute();
        $users = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            // Assurez-vous que l'ordre et les noms des propriétés correspondent à ceux de votre table
            $user = new User($row['ID'], $row['Nom'], $row['Mail'], null, $row['Ville'], $row['Age']);
            $users[] = $user;
        }
        return $users;
    }

    // Récupère un utilisateur par son identifiant
    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            return new User($row['Nom'], $row['Mail'], $row['Ville'], $row['Age']);
        }
        return null;
    }

    // Met à jour les informations d'un utilisateur dans la base de données
    public function update(User $user)
    {
        $stmt = $this->pdo->prepare("UPDATE utilisateurs SET nom = ?, mail = ?, ville = ?, age = ? WHERE id = ?");
        $stmt->execute([$user->getName(), $user->getEmail(), $user->getCity(), $user->getAge(), $user->getId()]);
    }

    // Supprime un utilisateur de la base de données par son identifiant
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
    }

}
