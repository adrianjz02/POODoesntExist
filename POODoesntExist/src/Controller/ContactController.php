<?php
class ContactController
{
    public function traiterFormulaire()
    {
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $ville = $_POST['ville'];
        $age = $_POST['age'];

        $this->envoyerEmail($nom, $email, $message);
    }

    private function envoyerEmail($nom, $email, $message)
    {

    }
    public function read()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function showContactForm()
    {
        include 'contact.php';
    }
}

// Créer une instance du contrôleur et appeler la fonction de traitement
$controller = new ContactController();
$controller->traiterFormulaire();

<<<<<<< HEAD:POODoesntExist/src/Controller/ContactController.php



require_once 'Model.php'; // Assuming a Model class is available

class ContactController {
    private $model;

    public function __construct() {
        $this->model = new Model(); // Or a specific ContactModel
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Extract data from POST request
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';
            $ville = $_POST['ville'] ?? '';
            $age = $_POST['age'] ?? '';

            // Validate and save data using the model
            // This is a placeholder - implement specific logic for saving data
            $this->model->saveContact($nom, $email, $message, $ville, $age);

            // Redirect or display a success message
        }
    }

    public function read() {
        // Fetch contact entries using the model
        // This is a placeholder - implement specific logic for fetching data
        return $this->model->getAllContacts();
    }

    public function update() {
        // Placeholder for the update logic
    }

    public function delete() {
        // Placeholder for the delete logic
    }

    public function showContactForm() {
        include 'contact.php';
    }
}

=======
>>>>>>> 592d4a696844e8a1ad8c46fb1d8fca2d1378533c:POODoesntExist/ContactController.php
?>