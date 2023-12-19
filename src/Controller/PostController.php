<?php
// PDO
// ouvrir une connexion avec la bdd (PDO)
// faire un try catch pour tester si la bdd est bien connecté
// créer la base de donnée et la table
// tout ça dans phpmyadmin
// on créé l'objet
// on créé le repository
// on reprend le formulaire et les données qu'on reçoit on les envoit dans la bdd

namespace App\Controller;

use App\Database\DatabaseConnection;
use App\Database\UserRepository;
use App\Database\User;

require_once __DIR__ . '/../DataBase/DataBaseConnection.php';
require_once __DIR__ . '/../DataBase/UserRepositary.php';

use App\Controller\BaseController;
use Twig\Environment;

//require 'dbconfig.php';
//require 'User.php';
//require 'UserRepository.php';

final class PostController extends BaseController
{
    public function list(): array
    {
        return [];
    }

    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nom = htmlspecialchars($_POST['nom'] ?? '');
            $email = htmlspecialchars($_POST['email'] ?? '');
            $message = htmlspecialchars($_POST['message'] ?? '');
            $ville = htmlspecialchars($_POST['ville'] ?? '');
            $age = htmlspecialchars($_POST['age'] ?? '');


            // Créez une instance de PDO et UserRepositary
            $dbConnection = new DataBaseConnection();
            $connexion = $dbConnection->openConnection();

            $userRepository = new UserRepository($connexion);

            // Créez une instance de User
            $user = new User(null, $nom, $email, $message, $ville, $age);

            // Utilisez UserRepository pour sauvegarder le nouvel utilisateur
            $userRepository->save($user);

            echo $this->render('post/detail.html.twig', [
                'nom' => $nom,
                'email' => $email,
                'message' => $message,
                'ville' => $ville,
                'age' => $age
            ]);
        } else {
            echo $this->render('post/create.html.twig', []);
        }
    }



    public function listEnum()
    {
        $data = [
            'data1' => ['nom' => 'Penguinz', 'prenom' => 'Adrian', 'email' => 'adr@penguin.com', 'adresse' => '25 rue du pole nord'],
            'data2' => ['nom' => 'Kim', 'prenom' => 'Seohno', 'email' => 'kim@', 'adresse' => '13 rue Hir'],
            'data3' => ['nom' => 'Sagna', 'prenom' => 'Maké', 'email' => 'maké@', 'adresse' => '14 rue ...'],
        ];

        echo $this->render('post/liste.html.twig', ['data' => $data]);
    }

    public function listEnumBDD()
    {
        $dbConnection = new DataBaseConnection();
        $connexion = $dbConnection->openConnection();
        //$pdo = new \PDO('mysql:host=localhost;dbname=utilisateurs', 'root', ''); // Remplacez avec vos propres paramètres
        $userRepository = new UserRepository($connexion);

        $utilisateurs = $userRepository->findAll();
        echo $this->render('post/listebdd.html.twig', ['utilisateurs' => $utilisateurs]);
    }


    public function read()
    {
        echo $this->render('index.html.twig', []);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
