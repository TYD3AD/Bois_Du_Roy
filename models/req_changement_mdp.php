<?php

function verification_mdp()
{
    include 'connexion_serveur.php';
    include 'session.php';
    // si le bouton envoyer est cliqué
    if (isset($_POST['submit'])) {
        // on récupère les données du formulaire
        $current_mdp = htmlspecialchars($_POST['current_mdp']);
        $new_mdp = htmlspecialchars($_POST['new_mdp']);
        $conf_mdp = htmlspecialchars($_POST['conf_mdp']);
        $matricule = $_SESSION['matricule'];
        // on vérifie si les champs sont remplis
        if (!empty($current_mdp) and !empty($new_mdp) and !empty($conf_mdp)) {
            // on vérifie si le nouveau mot de passe est identique à la confirmation
            if ($new_mdp === $conf_mdp) {
                // on vérifie si le mot de passe actuel est correct
                $req = $db->prepare('SELECT MOT_DE_PASSE FROM COMPTE WHERE MATRICULE = :matricule');
                $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
                $req->execute();
                $resultat = $req->fetch();
                // on vérifie si le mot de passe actuel est correct
                if (password_verify($current_mdp, $resultat['MOT_DE_PASSE'])) {
                    // on hash le nouveau mot de passe
                    $new_mdp = password_hash($new_mdp, PASSWORD_BCRYPT);
                    // on met à jour le mot de passe dans la base de données
                    $req = $db->prepare('UPDATE COMPTE SET MOT_DE_PASSE = :new_mdp, MOT_DE_PASSE_BACK = 0 WHERE MATRICULE = :matricule');
                    $req->bindValue(':new_mdp', $new_mdp, PDO::PARAM_STR);
                    $req->bindValue(':matricule', $matricule, PDO::PARAM_STR);
                    $req->execute();
                    // on redirige vers la page de profil
                    $_SESSION['erreur'] = '<p class="succes">Le mot de passe a bien été modifié</p>';
                    $_SESSION['mdp_back'] = "Ok";
                } else {
                    $_SESSION['erreur'] = '<p class="erreur">Le mot de passe actuel est incorrect</p>';
                }
            } else {
                $_SESSION['erreur'] = '<p class="erreur">Les deux mots de passe ne sont pas identiques</p>';
            }
        } else {
            $_SESSION['erreur'] = '<p class="erreur">Veuillez remplir tous les champs</p>';
        }
    }
}
