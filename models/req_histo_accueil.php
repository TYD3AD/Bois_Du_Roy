<?php
include 'session.php';
include 'connexion_serveur.php';


//récupère le congé le plus récent du salarié
$sql = "SELECT * FROM DEMANDE_CONGE WHERE MATRICULE = :matricule AND STATUT_DEMANDE_CONGE != 1 ORDER BY ID_DEMANDE_CONGE DESC LIMIT 3";

$query = $db->prepare($sql);
$query->bindValue(':matricule', $_SESSION['matricule'], PDO::PARAM_STR);
$query->execute();
$histo = $query->fetchAll();

if ($histo == false) {
    echo '<h2>Vous n\'avez pas encore fait de demande de congé</h2>';
} else {


    // conversion dates yyyy-mm-dd -> dd/mm/yyyy
    foreach ($histo as $key => $value) {
        $histo[$key]['DATE_DEBUT'] = date("d/m/Y", strtotime($value['DATE_DEBUT']));
        $histo[$key]['DATE_FIN'] = date("d/m/Y", strtotime($value['DATE_FIN']));
    }

    // affichage des données dans un tableau

    echo '<h2>Vos dernières demandes statuées</h2>';
    echo '<table class="tab_accueil">';
    echo '<tr>';
    echo '<th class="tab_accueil_nom">Date Début</th>';
    echo '<th class="tab_accueil_nom">Date Fin</th>';
    echo '<th class="tab_accueil_nom">Motif</th>';
    echo '</tr>';
    foreach ($histo as $key => $value) {
        echo '<tr>';
        echo '<td class="tab_accueil_values">' . $value['DATE_DEBUT'] . '</td>';
        echo '<td class="tab_accueil_values">' . $value['DATE_FIN'] . '</td>';
        echo '<td class="tab_accueil_values tab_motif">' . $value['MOTIF_DEMANDE'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
