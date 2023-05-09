<?php
include 'session.php';
include 'connexion_serveur.php';


//récupère le congé le plus récent du salarié
$sql = "SELECT * FROM DEMANDE_CONGE WHERE MATRICULE = :matricule ORDER BY ID_DEMANDE_CONGE DESC LIMIT 1";

$query = $db->prepare($sql);
$query->bindValue(':matricule', $_SESSION['matricule'], PDO::PARAM_STR);
$query->execute();
$demande = $query->fetch();

if ($demande == false) {
   echo '<h2>Vous n\'avez pas encore fait de demande de congé</h2>';
} else {

   // conversion dates yyyy-mm-dd -> dd/mm/yyyy
   $demande['DATE_DEBUT'] = date("d/m/Y", strtotime($demande['DATE_DEBUT']));
   $demande['DATE_FIN'] = date("d/m/Y", strtotime($demande['DATE_FIN']));

   // affichage des données dans un tableau
   echo '<h2>Votre dernière demande</h2>';
   echo '<table class="tab_accueil">';
   echo '<tr>';
   echo '<th class="tab_accueil_nom">Date Début</th>';
   echo '<th class="tab_accueil_nom">Date Fin</th>';
   echo '<th class="tab_accueil_nom ">Motif</th>';
   echo '</tr>';
   echo '<tr>';
   echo '<td class="tab_accueil_values">' . $demande['DATE_DEBUT'] . '</td>';
   echo '<td class="tab_accueil_values">' . $demande['DATE_FIN'] . '</td>';
   echo '<td class="tab_accueil_values tab_motif">' . $demande['MOTIF_DEMANDE'] . '</td>';
   echo '</tr>';
   echo '</table>';
}
