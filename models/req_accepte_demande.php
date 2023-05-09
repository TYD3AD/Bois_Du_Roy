<?php
include 'connexion_serveur.php';
$ID_DEMANDE = $_GET['id'];
$matricule = $_GET['matricule'];

$sql = "UPDATE DEMANDE_CONGE SET STATUT_DEMANDE_CONGE = 2, VALIDATEUR = :matricule WHERE ID_DEMANDE_CONGE = :ID_DEMANDE";

$query = $db->prepare($sql);
$query->bindValue(':ID_DEMANDE', $ID_DEMANDE, PDO::PARAM_STR);
$query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
$query->execute();


header('Location: ../pages/gestion_demande.php');
