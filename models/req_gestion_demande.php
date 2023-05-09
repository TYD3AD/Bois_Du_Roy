<?php
include '../models/connexion_serveur.php';
$matricule = $_SESSION['matricule'];


$sql = "SELECT ID_DEMANDE_CONGE, CONCAT(PRENOM, ' ',NOM ) AS NOM, DATE_DEMANDE, DEMANDE_CONGE.MATRICULE, DATE_DEBUT, DATE_FIN, MOTIF_DEMANDE, TYPE_CONGE_DEMANDE FROM DEMANDE_CONGE INNER JOIN EMPLOYE ON DEMANDE_CONGE.MATRICULE = EMPLOYE.MATRICULE WHERE EMPLOYE.MATRICULE_RESPONSABLE = :matricule AND STATUT_DEMANDE_CONGE = 1";
$query = $db->prepare($sql);
$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
$query->execute();
$demandes = $query->fetchAll();

foreach ($demandes as $key => $value) {
    // conversion dates yyyy-mm-dd -> dd/mm/yyyy
    $demandes[$key]['DATE_DEMANDE'] = date("d/m/Y", strtotime($value['DATE_DEMANDE']));
    $demandes[$key]['DATE_DEBUT'] = date("d/m/Y", strtotime($value['DATE_DEBUT']));
    $demandes[$key]['DATE_FIN'] = date("d/m/Y", strtotime($value['DATE_FIN']));
}
?>