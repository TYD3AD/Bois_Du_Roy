<?php
// requete recupération des soldes de congés de l'employé
include 'connexion_serveur.php';
$matricule = $_SESSION['matricule'];
$sql = "SELECT * FROM CONGE WHERE MATRICULE = :matricule";
$query = $db->prepare($sql);
$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
$query->execute();
$result = $query->fetchAll();
// affichage des soldes de congés de l'employé dans un tableau
echo '<h2>Votre solde</h2>';
echo '<table class="tab_accueil">';
echo '<tr>';
echo '<th class="tab_accueil_nom">Congés Payés</th>';
echo '<th class="tab_accueil_nom">RTT</th>';

echo '</tr>';
echo '<tr>';
echo '<td class="tab_accueil_values">' . $result[0]['CONGE_RESTANT'] . ' jours</td>';
echo '<td class="tab_accueil_values">' . $result[1]['CONGE_RESTANT'] . ' jours</td>';
echo '</tr>';
echo '</table>';
