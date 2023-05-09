<?php
function verification()
{
    require '../models/session.php';

    //vérifie que la date de fin n'est pas antérieur à la date de début
    if (isset($_POST['date_debut']) && isset($_POST['date_fin'])) {
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];
        if ($date_fin < $date_debut) {
            // ajoute une erreur dans la session
            $_SESSION['erreur'] = 'La date de fin ne peut pas être antérieure à la date de début';
        } else {
            //vérifie que la date de début n'est pas antérieur à la date du jour
            $date_jour = date('Y-m-d');
            if ($date_debut < $date_jour) {
                $_SESSION['erreur'] =  'La date de début ne peut pas être antérieure à la date du jour';
            } else {
                //vérifie qu'une radio est sélectionnée
                $type_conge = $_POST['radio_conge'];
                if (empty($type_conge)) {
                    $_SESSION['erreur'] =  'Veuillez sélectionner un type de congé';
                }
            }
        }
    }

    //récupère le nom de la radio sélectionnée
    $type_conge = $_POST['radio_conge'];
    if ($type_conge == 'RTT') {
        $id_type_conge = 2;
    } elseif ($type_conge == 'CP') {
        $id_type_conge = 1;
    }

    //vérifie que le nombre de jours de congé demandé ne dépasse pas le nombre de jours de congé restant correspondant à la radio sélectionnée
    if (isset($_POST['date_debut']) && isset($_POST['date_fin']) && isset($_POST['radio_conge'])) {
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];
        $type_conge = $_POST['radio_conge'];
        $date_debut = new DateTime($date_debut);
        $date_fin = new DateTime($date_fin);
        $interval = $date_debut->diff($date_fin);
        $nb_jours = $interval->format('%a');
        $nb_jours = $nb_jours + 1;
        if ($type_conge == 'RTT') {
            if ($nb_jours > $conge[1]['CONGE_RESTANT'] || $conge[1]['CONGE_RESTANT'] === 0) {
                $_SESSION['erreur'] =  'Le nombre de jours sélectionné dépasse votre solde de RTT';
            }
        } elseif ($type_conge == 'CP') {
            if ($nb_jours > $conge[0]['CONGE_RESTANT'] || $conge[0]['CONGE_RESTANT'] === 0) {
                $_SESSION['erreur'] =  'Le nombre de jours sélectionné dépasse votre solde de congés payés';
            }
        }
    }
    //vérifie que le motif n'est pas vide
    if (isset($_POST['motif'])) {
        if (empty($_POST['motif'])) {
            $_SESSION['erreur'] =  'Le motif ne peut pas être vide';
        }
    } else {
        $_SESSION['erreur'] =  'Champs motif non remplis';
    }
    $varVerif = ['id_type_conge' => $id_type_conge];
    //vérifie que la session erreur est vide
    if (empty($_SESSION['erreur'])) {
        $varVerif['verif'] = true;
    } else {
        $varVerif['verif'] = false;
    }
    return $varVerif;
}







$resultat = verification();
$id_type_conge = $resultat['id_type_conge'];
$verif = $resultat['verif'];

//insertion de la demande de congé dans la base de données
if ($verif == true) {
    require '../models/session.php';
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $motif = strip_tags($_POST['motif']);
    //$type_conge = $_POST['radio_conge'];
    $date_debut = new DateTime($date_debut);
    $date_fin = new DateTime($date_fin);
    $interval = $date_debut->diff($date_fin);
    $nb_jours = $interval->format('%a');
    $nb_jours = $nb_jours + 1;
    $soustraction;
    if ($id_type_conge == 1) {
        $soustraction = $conge[0]['CONGE_RESTANT'] - $nb_jours;
    } elseif ($id_type_conge == 2) {
        $soustraction = $conge[1]['CONGE_RESTANT'] - $nb_jours;
    }
    include '../models/connexion_serveur.php';
    $sql = "INSERT INTO DEMANDE_CONGE (ID_DEMANDE_CONGE, MATRICULE, DATE_DEMANDE, DATE_DEBUT, DATE_FIN, MOTIF_DEMANDE, STATUT_DEMANDE_CONGE, TYPE_CONGE_DEMANDE, VALIDATEUR) VALUES (NULL, :matricule, curdate(), :date_debut, :date_fin, :motif, 1, :id_type_conge, NULL)";
    $query = $db->prepare($sql);
    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $query->bindValue(':date_debut', $date_debut->format('Y-m-d'), PDO::PARAM_STR);
    $query->bindValue(':date_fin', $date_fin->format('Y-m-d'), PDO::PARAM_STR);
    $query->bindValue(':id_type_conge', $id_type_conge, PDO::PARAM_STR);
    $query->bindValue(':motif', $motif, PDO::PARAM_STR);
    $query->execute();
    echo '<p>Votre demande de congé a bien été prise en compte. </p><br>';
    $sql = "UPDATE CONGE SET CONGE_RESTANT = :soustraction WHERE MATRICULE = :matricule AND ID_TYPE_CONGE = :id_type_conge";
    $query = $db->prepare($sql);
    $query->bindValue(':soustraction', $soustraction, PDO::PARAM_STR);
    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $query->bindValue(':id_type_conge', $id_type_conge, PDO::PARAM_STR);
    $query->execute();
    echo '<p>Votre solde de congé a bien été mis à jour.</p>';
}
