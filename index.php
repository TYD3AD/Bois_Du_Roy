<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="publics/css/style.css">
    <title>Connexion</title>
</head>

<body>
    <main>
        <div class="partieGauche">
            <img src="publics/img/Logo.svg" alt="Logo_entreprise">
        </div>
        <div class="partieDroite">
            <!-- Formulaire de connexion matricule mot de passe bouton se connecter et mot de passe oublié -->
            <form action="models/connexion.php" method="post" class="formConnexion">
                <div class="formInput">
                    <input type="text" name="matricule" id="matricule" placeholder="Matricule" required>
                    <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required>
                </div>
                <div class="formButton">
                    <span><button type="submit" id="seConnecter">Se Connecter</button></span>
                </div>
            </form>
        </div>
    </main>
</body>

</html>