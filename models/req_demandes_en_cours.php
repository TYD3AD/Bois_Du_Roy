<?php
include 'session.php';


// connexion à la base de données
include 'connexion_serveur.php';

//REQUETE TABLE DEMANDE_CONGE -> HISTORIQUE
$sql = "SELECT ID_DEMANDE_CONGE, DATE_DEBUT, DATE_FIN, MOTIF_DEMANDE FROM DEMANDE_CONGE WHERE MATRICULE = :matricule AND STATUT_DEMANDE_CONGE = 1";

// préparation de la requête
$query = $db->prepare($sql);

// liaison des paramètres
$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);

// exécution de la requête
$query->execute();

// récupération des données
$demandes = $query->fetchAll();

foreach ($demandes as $key => $value) {
    // conversion dates yyyy-mm-dd -> dd/mm/yyyy
$demandes[$key]['DATE_DEBUT'] = date("d/m/Y", strtotime($value['DATE_DEBUT']));
$demandes[$key]['DATE_FIN'] = date("d/m/Y", strtotime($value['DATE_FIN']));
}
