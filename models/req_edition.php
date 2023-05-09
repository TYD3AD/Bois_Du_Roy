<?php
//session_start();
$matricule = $_SESSION['matricule'];
$id = $_GET['id'];
// Connexion à la base de données
include('connexion_serveur.php');

// Récupération des données de la demande
$req = ('SELECT ID_TYPE_CONGE, ID_DEMANDE_CONGE, MATRICULE, DATE_DEBUT, DATE_FIN,MOTIF_DEMANDE, TYPE_CONGE_DEMANDE, NOM_TYPE_CONGE, MOTIF_DEMANDE FROM DEMANDE_CONGE
 INNER JOIN TYPE_CONGE ON DEMANDE_CONGE.TYPE_CONGE_DEMANDE=TYPE_CONGE.ID_TYPE_CONGE WHERE MATRICULE = :matricule
  AND ID_DEMANDE_CONGE = :id');
$query = $db->prepare($req);
$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
$query->bindValue(':id', $id, PDO::PARAM_STR);
$query->execute();
$donnees = $query->fetch();

?>

<form action="" method="POST" class="form_edition">
    <div class="form_edition_dates">
        <section>
            <label for="date_debut" class="form_label">Date de début</label>
            <input type="date" name="date_debut" id="date_debut" value="<?php echo $donnees['DATE_DEBUT']; ?>">
        </section>
        <section>
            <label for="date_fin" class="form_label">Date de fin</label>
            <input type="date" name="date_fin" id="date_fin" value="<?php echo $donnees['DATE_FIN']; ?>">
        </section>
    </div>
    <textarea name="motif" id="motif" cols="30" rows="10" placeholder="Motif"><?php echo $donnees['MOTIF_DEMANDE']; ?></textarea>
    <label for="type_conge" class="form_label">Type de congé</label>
    <select name="type_conge" id="type_conge">
        <?php
        if ($donnees['TYPE_CONGE_DEMANDE'] == 2) {
            echo '<option value="1" selected>RTT</option>';
            echo '<option value="2">Congé payé</option>';
        } else {
            echo '<option value="1">RTT</option>';
            echo '<option value="2" selected>Congé payé</option>';
        }
        ?>
    </select>
    <button type="submit" value="Modifier" class="btn_edit_modif">Modifier</button>
    <?php
    // Vérifie si le formulaire a été envoyé
    if (isset($_POST['date_debut']) && isset($_POST['date_fin']) && isset($_POST['motif']) && isset($_POST['type_conge'])) {

        // récupère les dates avant modification
        $date_debut_avant = $donnees['DATE_DEBUT'];
        $date_fin_avant = $donnees['DATE_FIN'];

        // récupère les dates après modification
        $date_debut_apres = $_POST['date_debut'];
        $date_fin_apres = $_POST['date_fin'];

        //récupère la date du jour
        $date = date('Y-m-d');

        // récupère le type de congé
        $type_conge = $_POST['type_conge'];




        // Vérifie si les dates ont été modifiées
        if ($date_debut_avant != $date_debut_apres || $date_fin_avant != $date_fin_apres) {

            // vérifie que les dates sont valides
            if ($date_debut_avant > $date_fin_apres || $date_debut_apres > $date_fin_avant  || $date_debut_apres > $date_fin_apres || $date_debut_avant > $date_fin_avant) {
                echo 'La date de début doit être inférieure à la date de fin';
                return false;
            } else {
                if ($date_debut_apres < $date) {
                    echo 'La date de début doit être supérieure à la date du jour';
                    return false;
                }
            }
        }

        // si la vérification est ok, on continue
        if (true) {

            // calcul le nombre de jours de congés
            $date_debut = strtotime($date_debut_apres);
            $date_fin = strtotime($date_fin_apres);
            $nb_jours = ($date_fin - $date_debut) / 86400;
            $nb_jours = $nb_jours + 1;

            // calcul le nombre de jours de congés avant modification
            $date_debut = strtotime($date_debut_avant);
            $date_fin = strtotime($date_fin_avant);
            $nb_jours_avant = ($date_fin - $date_debut) / 86400;
            $nb_jours_avant = $nb_jours_avant + 1;

            // vérifie si le type de congé a été modifié
            if ($donnees['TYPE_CONGE_DEMANDE'] != $type_conge) {

                $ancien_type = $donnees['TYPE_CONGE_DEMANDE'];


                // récupère le solde du nouveau type de congé
                $req = ('SELECT CONGE_RESTANT FROM CONGE WHERE MATRICULE = :matricule AND ID_TYPE_CONGE = :id');
                $query = $db->prepare($req);
                $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
                $query->bindValue(':id', $type_conge, PDO::PARAM_STR);
                $query->execute();
                $donnees = $query->fetch();
                $solde = $donnees['CONGE_RESTANT'];

                // vérifie si le solde est suffisant
                if ($solde <= $nb_jours) {
                    echo 'Le solde est insuffisant';
                } else {
                    $motif = strip_tags($_POST['motif']);
                    // met à jour la demande de congé
                    $req = ('UPDATE DEMANDE_CONGE SET DATE_DEBUT = :date_debut, DATE_FIN = :date_fin, MOTIF_DEMANDE = :motif, TYPE_CONGE_DEMANDE = :type_conge WHERE ID_DEMANDE_CONGE = :id');
                    $query = $db->prepare($req);
                    $query->bindValue(':date_debut', $date_debut_apres, PDO::PARAM_STR);
                    $query->bindValue(':date_fin', $date_fin_apres, PDO::PARAM_STR);
                    $query->bindValue(':motif', $motif, PDO::PARAM_STR);
                    $query->bindValue(':type_conge', $type_conge, PDO::PARAM_STR);
                    $query->bindValue(':id', $id, PDO::PARAM_STR);
                    $query->execute();

                    // met à jour le solde du nouveau type de congé
                    $req = ('UPDATE CONGE SET CONGE_RESTANT = CONGE_RESTANT - :nb_jours WHERE MATRICULE = :matricule AND ID_TYPE_CONGE = :id');
                    $query = $db->prepare($req);
                    $query->bindValue(':nb_jours', $nb_jours, PDO::PARAM_STR);
                    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
                    $query->bindValue(':id', $type_conge, PDO::PARAM_STR);
                    $query->execute();

                    // met à jour le solde du type de congé précédent
                    $req = ('UPDATE CONGE SET CONGE_RESTANT = CONGE_RESTANT + :nb_jours WHERE MATRICULE = :matricule AND ID_TYPE_CONGE = :id');
                    $query = $db->prepare($req);
                    $query->bindValue(':nb_jours', $nb_jours_avant, PDO::PARAM_STR);
                    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
                    $query->bindValue(':id', $ancien_type, PDO::PARAM_STR);
                    $query->execute();
                }
            } else {
                // récupère le solde du type de congé
                $req = ('SELECT CONGE_RESTANT FROM CONGE WHERE MATRICULE = :matricule AND ID_TYPE_CONGE = :type_conge');
                $query = $db->prepare($req);
                $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
                $query->bindValue(':type_conge', $donnees['TYPE_CONGE_DEMANDE'], PDO::PARAM_STR);
                $query->execute();
                $donnees = $query->fetch();
                $solde = $donnees['CONGE_RESTANT'];

                // vérifie si le solde est insuffisant
                if ($solde + $nb_jours_avant < $nb_jours) {
                    echo 'Le solde est insuffisant';
                    echo $nb_jours;
                    echo '<br>';
                    echo $solde;
                } else {
                    // met à jour la demande de congé
                    $req = ('UPDATE DEMANDE_CONGE SET DATE_DEBUT = :date_debut, DATE_FIN = :date_fin, MOTIF_DEMANDE = :motif, TYPE_CONGE_DEMANDE = :type_conge WHERE ID_DEMANDE_CONGE = :id');
                    $query = $db->prepare($req);
                    $query->bindValue(':date_debut', $_POST['date_debut'], PDO::PARAM_STR);
                    $query->bindValue(':date_fin', $_POST['date_fin'], PDO::PARAM_STR);
                    $query->bindValue(':motif', $_POST['motif'], PDO::PARAM_STR);
                    $query->bindValue(':type_conge', $_POST['type_conge'], PDO::PARAM_STR);
                    $query->bindValue(':id', $id, PDO::PARAM_STR);
                    $query->execute();

                    // met à jour le solde du type de congé
                    $req = ('UPDATE CONGE SET CONGE_RESTANT = CONGE_RESTANT - :nb_jours WHERE MATRICULE = :matricule AND ID_TYPE_CONGE = :id');
                    $query = $db->prepare($req);
                    $query->bindValue(':nb_jours', $nb_jours - $nb_jours_avant, PDO::PARAM_STR);
                    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
                    $query->bindValue(':id', $type_conge, PDO::PARAM_STR);
                    $query->execute();
                    $_SESSION['message_edit'] = 'La demande de congé a bien été modifiée';
                    header('Refresh: 0');
                }
            }
        }
    } ?>
</form>