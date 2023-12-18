<?php
class ContactController
{
    public function traiterFormulaire()
    {
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['message'] ?? '';
        $ville = $_POST['ville'] ?? '';
        $age = $_POST['age'] ?? 0;

        $this->envoyerEmail($nom, $email, $message);
    }

    // Exemple de fonction pour envoyer un email (à compléter)

    private function envoyerEmail($nom, $email, $message)
    {
        // Code pour envoyer un email
    }
    public function read()
    {
        // Fetch contact entries using the model
        // This is a placeholder - implement specific logic for fetching data
        return $this->model->getAllContacts();
    }

    public function update()
    {
        // Placeholder for the update logic
    }

    public function delete()
    {
        // Placeholder for the delete logic
    }

    public function showContactForm()
    {
        include 'contact.php';
    }
}

// Créer une instance du contrôleur et appeler la fonction de traitement
$controller = new ContactController();
$controller->traiterFormulaire();

?>