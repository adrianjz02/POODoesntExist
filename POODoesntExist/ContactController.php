<?php
class ContactController {
    public function traiterFormulaire() {
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';
        $ville = $_POST['ville'] ?? '';
        $age = $_POST['age'] ?? 0;

        // $this->envoyerEmail($nom, $email, $message);
    }

    // Exemple de fonction pour envoyer un email (à compléter)
    private function envoyerEmail($nom, $email, $message) {
        // Code pour envoyer un email
    }
}

// Créer une instance du contrôleur et appeler la fonction de traitement
$controller = new ContactController();
$controller->traiterFormulaire();
