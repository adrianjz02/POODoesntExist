<?php

require_once 'path/to/CommandeRepository.php'; // Mettez à jour avec le chemin correct vers votre CommandeRepository

class CommandeController
{
    private $commandeRepository;

    public function __construct()
    {
        // Initialisez votre connexion PDO ici, et passez-la à votre CommandeRepository
        $pdo = new PDO('mysql:host=your_host;dbname=your_db', 'username', 'password'); // Mettez à jour avec vos propres informations de connexion
        $this->commandeRepository = new CommandeRepository($pdo);
    }

    public function liste()
    {
        $commandes = $this->commandeRepository->findAllWithUserDetails();
        include 'path/to/listeCommandes.php'; // Mettez à jour avec le chemin correct vers votre template listeCommandes
    }

    public function create()
    {
        // Afficher le formulaire de création de commande
        $this->render('commande/createCommande.html.twig');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numeroCommande = $_POST['numeroCommande'] ?? '';
            $utilisateurId = $_POST['utilisateurId'] ?? 0;

            // Valider les données ici si nécessaire

            // Créer l'objet Commande et sauvegarder la commande
            $commande = new Commande(null, $numeroCommande, $utilisateurId);
            $this->commandeRepository->save($commande);

            // Rediriger vers la page des commandes ou afficher un message de succès
            // $this->redirect('/chemin_vers_la_page_de_succes');
            // Ou afficher un message
            // echo "Commande enregistrée avec succès!";
        } else {
            // Si ce n'est pas une requête POST, rediriger vers le formulaire de création
            $this->redirect('/chemin_vers_le_formulaire_de_creation');
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}

// Utilisation du contrôleur
$commandeController = new CommandeController();
$commandeController->liste();
