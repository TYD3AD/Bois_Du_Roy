<?php include('../models/session.php'); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../publics/css/style.css">
    <title>Changement de mot de passe</title>
</head>

<body>
    <main>
        <div class="partieGauche">
            <img src="../publics/img/Logo.svg" alt="Logo_entreprise">
        </div>
        <div class="partieDroite">
            <!-- Formulaire modification de mot de passe -->
            <form method="post" action="" class="form_changement_mdp">
                <h2>Changer le mot de passe</h2>
                <div class="champs_mdp">
                    <label for="mdp">Tapez votre mot de passe actuel*</label>
                    <input type="password" name="current_mdp" id="current_mdp" placeholder="Mot de passe actuel" required>
                </div>
                <div class="champs_mdp">
                    <label for="new_mdp">Tapez le nouveau mot de passe*</label>
                    <input type="password" name="new_mdp" id="new_mdp" placeholder="Nouveau mot de passe" required>
                </div>
                <div class="champs_mdp">
                    <label for="new_mdp2">Confirmez le nouveau mot de passe*</label>
                    <input type="password" name="conf_mdp" id="conf_mdp" placeholder="Confirmer le nouveau mot de passe" required>
                </div>
                <div class="btn_chgmntMDP">
                    <button type="submit" name="submit" id="btn_modif_mdp">Enregistrer le mot de passe</button>
                </div>
                <div class="reponse_submit">
                    <?php
                    // si le bouton envoyer est cliqué
                    if (isset($_POST['submit'])) {
                        require('../models/req_changement_mdp.php');
                        verification_mdp();
                        if(isset($_SESSION['mdp_back'])){
                            if($_SESSION['mdp_back'] == 'Ok'){
                                header('Location: accueil.php');
                            }
                        }
                        // vérifie si un erreur est stockée dans la session
                        if (isset($_SESSION['erreur'])) {
                            // affiche l'erreur
                            echo $_SESSION['erreur'];
                            // supprime l'erreur de la session
                            unset($_SESSION['erreur']);
                        }   
                    }
                    ?>
                </div>
            </form>
        </div>
    </main>
</body>

</html>