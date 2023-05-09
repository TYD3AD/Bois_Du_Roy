<?php
include 'session.php';


// connexion à la base de données
include 'connexion_serveur.php';

//REQUETE TABLE DEMANDE_CONGE -> HISTORIQUE
$sql = "SELECT DATE_DEBUT, DATE_FIN, MOTIF_DEMANDE, LIBELLE_STATUT, MOTIF_DECISION, VALIDATEUR FROM DEMANDE_CONGE INNER JOIN STATUT_DEMANDE ON DEMANDE_CONGE.STATUT_DEMANDE_CONGE=STATUT_DEMANDE.id_Statut WHERE MATRICULE = :matricule AND STATUT_DEMANDE_CONGE != 1";

// préparation de la requête
$query = $db->prepare($sql);

// liaison des paramètres
$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);

// exécution de la requête
$query->execute();

// récupération des données
$histo = $query->fetchAll();

foreach ($histo as $key => $value) {
    // conversion dates yyyy-mm-dd -> dd/mm/yyyy
    $histo[$key]['DATE_DEBUT'] = date("d/m/Y", strtotime($value['DATE_DEBUT']));
    $histo[$key]['DATE_FIN'] = date("d/m/Y", strtotime($value['DATE_FIN']));


    $validateur = $value['VALIDATEUR'];

    // REQUETE RECUPERATION NOM PRENOM VALIDATEUR
    $sql = "SELECT CONCAT(NOM, ' ', PRENOM) AS VALIDATEUR FROM EMPLOYE WHERE MATRICULE= :validateur";

    // préparation de la requête
    $query = $db->prepare($sql);

    // liaison des paramètres
    $query->bindValue(':validateur', $validateur, PDO::PARAM_STR);

    // exécution de la requête
    $query->execute();

    // récupération des données
    $valid = $query->fetch();

    $histo[$key]['VALIDATEUR'] = $valid['VALIDATEUR'];
}
