<?php
// PDO
// ouvrir une connexion avec la bdd
// faire un try catch pour tester si la bdd est bien connecté
// créer la base de donnée et la table
// tout ça dans phpmyadmin
// on créé l'objet
// on créé le repository
// on reprend le formulaire et les données qu'on reçoit on les envoit dans la bdd
namespace App\Controller;

use App\Controller\BaseController;
use Twig\Environment;

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
            'data1' => ['nom' => 'Jimenez', 'prenom' => 'Adrian', 'email' => 'adr@', 'adresse' => '12 rue ...'],
            'data2' => ['nom' => 'Kim', 'prenom' => 'Seohno', 'email' => 'kim@', 'adresse' => '13 rue ...'],
            'data3' => ['nom' => 'Sagna', 'prenom' => 'Maké', 'email' => 'maké@', 'adresse' => '14 rue ...'],
        ];

        echo $this->render('post/liste.html.twig', ['data' => $data]);
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
