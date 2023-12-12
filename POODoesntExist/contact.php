<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Votre Titre</title>
    <style>
        .header,
        .footer {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1>Mon Site Web</h1>
        <nav>
            <a href="#home">Accueil</a> |
            <a href="#contact">Contact</a> |
            <a href="#about">À Propos</a>
        </nav>
    </header>

    <main>
        <section class="container mt-4" align="center">
            <h2>Formulaire de Contact</h2>
            <form>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom">
                </div>
                <br>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Entrez votre email">
                </div>
                <br>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" rows="3"></textarea>
                </div>
                <br>

                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" class="form-control" id="ville" placeholder="Votre ville">
                </div>
                <br>

                <div class="form-group">
                    <label for="age">Âge</label>
                    <input type="number" class="form-control" id="age" placeholder="Votre âge">
                </div>
                <br>

                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2023 Mon Site Web. Tous droits réservés.</p>
    </footer>
</body>

</html>