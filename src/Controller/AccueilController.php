<?php

namespace App\Controller;

use App\Controller\BaseController;
use Twig\Environment;

final class AccueilController extends BaseController
{
    public function list(): array
    {
        return [];
    }

    public function show()
    {
        echo $this->render('post/createaccueil.html.twig', []);
        
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
