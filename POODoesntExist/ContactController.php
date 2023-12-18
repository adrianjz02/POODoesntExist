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
        $this->read($nom, $email, $message, $ville, $age); // Ajout pour appeler read()
    }

    private function envoyerEmail($nom, $email, $message)
    {
        // Code pour envoyer l'email
    }

    public function read($nom, $email, $message, $ville, $age)
    {
        // Afficher les données reçues
        echo "Nom: " . htmlspecialchars($nom) . "<br>";
        echo "Email: " . htmlspecialchars($email) . "<br>";
        echo "Message: " . htmlspecialchars($message) . "<br>";
        echo "Ville: " . htmlspecialchars($ville) . "<br>";
        echo "Âge: " . htmlspecialchars($age) . "<br>";
    }

    public function showContactForm()
    {
        include 'contact.php';
    }
}
$controller = new ContactController();
$controller->traiterFormulaire();

?>
ontroller->traiterFormulaire();

?>