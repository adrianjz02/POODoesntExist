<?php

namespace App\Database;

class UserRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(User $user)
    {
        if ($user->getId() === null) {
            $stmt = $this->pdo->prepare("INSERT INTO utilisateurs (nom, mail, ville, age) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user->getName(), $user->getEmail(), $user->getCity(), $user->getAge()]);
        } else {

        }
    }

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

    public function update(User $user)
    {
        $stmt = $this->pdo->prepare("UPDATE utilisateurs SET nom = ?, mail = ?, ville = ?, age = ? WHERE id = ?");
        $stmt->execute([$user->getName(), $user->getEmail(), $user->getCity(), $user->getAge(), $user->getId()]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
    }



}

