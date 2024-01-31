<?php

namespace App\Controller;

use App\Database\DatabaseConnection;
use App\Database\CommandeRepository;
use App\Database\Commande;

require_once __DIR__ . '/../DataBase/DataBaseConnection.php';
require_once __DIR__ . '/../DataBase/CommandeRepository.php';

use App\Controller\BaseController;

final class CommandeController extends BaseController
{
    private CommandeRepository $commandeRepository;

    public function __construct()
    {
        $dbConnection = new DatabaseConnection();
        $connexion = $dbConnection->openConnection();
        $this->commandeRepository = new CommandeRepository($connexion);
    }

    public function list(): array
    {
        // Retournez une liste de commandes à partir de la base de données
        return $this->commandeRepository->findAll();
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assurez-vous de valider et de nettoyer les entrées
            $numeroCommande = htmlspecialchars($_POST['numeroCommande'] ?? '');
            $utilisateurId = htmlspecialchars($_POST['utilisateurId'] ?? '');

            // Créez une instance de Commande
            $commande = new Commande(null, $numeroCommande, $utilisateurId);

            // Utilisez CommandeRepository pour sauvegarder la nouvelle commande
            $this->commandeRepository->save($commande);

            // Après avoir enregistré, renvoie vers la page d'accueil
            echo $this->render('post/createaccueil.html.twig', [
                'numeroCommande' => $numeroCommande
            ]);
        } else {
            // Si ce n'est pas une requête POST, renvoie vers la page d'accueil
            echo $this->render('post/createaccueil.html.twig', []);
        }
    }

   
}
