<?php
$title = 'Profil';
include('../common/header.php');
require('../models/session.php');
?>

<div class="infos_profil">
    <section class="nom_prenom">
        <div id="nom">
            <h3>Nom : </h3>
            <p> <?= $_SESSION['nom'] ?></p>
        </div>
        <div id="prenom">

            <h3>Prénom : </h3>
            <p> <?= $_SESSION['prenom'] ?></p>
        </div>
    </section>

    <div id="mail">
        <h3>Adresse mail : </h3>
        <p><?= $_SESSION['mail'] ?></p>
    </div>
    <section class="matricule_tel">
        <div id="matricule">
            <h3>Matricule : </h3>
            <p><?= $_SESSION['matricule'] ?></p>
        </div>
        <div id="telephone">
            <h3>Ligne directe : </h3>
            <p><?= $_SESSION['tel'] ?></p>
        </div>
        <div id="service">
        <h3>Service : </h3>
        <p><?= $_SESSION['service'] ?></p>
    </div>
    </section>

    <div class="page_profil_chgmntMDP">
        <h2>Changer le mot de passe</h2>
        <form method="post" action="">
            <div class="champs">
                <label for="mdp">Tapez votre mot de passe actuel*</label>
                <input type="password" name="current_mdp" id="current_mdp" placeholder="Mot de passe actuel" required>
            </div>
            <div class="champs">
                <label for="new_mdp">Tapez le nouveau mot de passe*</label>
                <input type="password" name="new_mdp" id="new_mdp" placeholder="Nouveau mot de passe" required>
            </div>
            <div class="champs">
                <label for="new_mdp2">Confirmez le nouveau mot de passe*</label>
                <input type="password" name="conf_mdp" id="conf_mdp" placeholder="Confirmer le nouveau mot de passe" required>
            </div>
            <div class="champs champs_submit">
                <button type="submit" name="submit">Enregistrer le mot de passe</button>
            </div>
            <div class="reponse_submit">
                <?php
                // si le bouton envoyer est cliqué
                if (isset($_POST['submit'])) {
                    include('../models/req_changement_mdp.php');
                    verification_mdp();
                    // vérifie si un erreur est stockée dans la session
                    if (isset($_SESSION['erreur'])) {
                        echo $_SESSION['erreur'];
                        unset($_SESSION['erreur']);
                    }
                }
                ?>
            </div>
        </form>

    </div>
</div>