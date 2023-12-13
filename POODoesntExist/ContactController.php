<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>

    <?php

    require_once 'Routeur.php';
    require_once 'ContactController.php';

    // Utilisation du routeur
    $routeur = new Routeur($_GET['page'] ?? 'default');

    $routeur->addRoute('contact', function () {
        include 'contact.php';
    });

    $routeur->addRoute('accueil', function () {
        include 'accueil.php';
    });


    $contactController = new ContactController();

// Define routes
$routeur->addRoute('contact', function() use ($contactController) {
    $contactController->showContactForm();
});

$routeur->addRoute('contact/submit', function() use ($contactController) {
    $contactController->create();
});


    $routeur->route();

    ?>

</body>

</html>