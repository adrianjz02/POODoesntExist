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
        echo $this->render('post/create.html.twig', []);

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
