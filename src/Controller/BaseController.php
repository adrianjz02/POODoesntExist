<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class BaseController
{
    public function render(string $template, array $variables): string
    {
        
        $loader = new FilesystemLoader(sprintf('%s/templates/', dirname(__DIR__)));
        $twig = new Environment($loader, [
            'debug' => true,
            'path' => true,
        ]);
        $twig->addExtension(new DebugExtension());

        return $twig->render($template, $variables);
    }
}
