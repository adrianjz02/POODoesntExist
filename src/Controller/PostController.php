<?php

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
