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


        $this->read($nom, $email, $message, $ville, $age);

    }

    private function envoyerEmail($nom, $email, $message)
    {

    }
    public function read($nom, $email, $message, $ville, $age) {

        return $this->mail($nom, $email, $message, $ville, $age);
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

?>