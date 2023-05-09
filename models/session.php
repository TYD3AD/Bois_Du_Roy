<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

//session_start();
if (!isset($_SESSION['matricule'])) {
    header("Location: ../index.php");
    exit();
}

$matricule = $_SESSION['matricule'];

// initialisation de la bdd
try {


    // REQUETE TABLE COMPTE

    //connexion à la base de données
    include 'connexion_serveur.php';
    // requête SQL pour récupérer les données du compte
    $sql = "SELECT * FROM COMPTE WHERE MATRICULE = :matricule";
    // préparation de la requête
    $query = $db->prepare($sql);
    // liaison des paramètres
    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    // exécution de la requête
    $query->execute();
    // récupération des données
    $result = $query->fetch();


    // REQUETE TABLE EMPLOYE

    // requête SQL pour récupérer les données de l'employé correspondant au compte
    $sql = "SELECT * FROM EMPLOYE WHERE MATRICULE = :matricule";
    // préparation de la requête
    $query = $db->prepare($sql);
    // liaison des paramètres
    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    // exécution de la requête
    $query->execute();
    // récupération des données
    $employe = $query->fetch();


    // REQUETE TABLE SERVICE

    // requête SQL pour récupérer les données du service de l'employé
    $sql = "SELECT ID_TYPE_CONGE, CONGE_RESTANT, CONGE_ACQUIS FROM CONGE WHERE MATRICULE= :matricule;";
    // préparation de la requête
    $query = $db->prepare($sql);
    // liaison des paramètres
    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    // exécution de la requête
    $query->execute();
    // récupération des données
    $conge = $query->fetchAll();

    // REQUETE TABLE SERVICE
    $sql="SELECT NOM_SERVICE FROM SERVICE INNER JOIN EMPLOYE ON EMPLOYE.ID_SERVICE = SERVICE.ID_SERVICE WHERE MATRICULE = :matricule";
    // préparation de la requête
    $query = $db->prepare($sql);
    // liaison des paramètres
    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    // exécution de la requête
    $query->execute();
    // récupération des données
    $service = $query->fetch();




} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    echo "Le numéro de l'erreur est : " . $e->getCode();
    die();
}

// stockage des données de l'employé en session
$_SESSION['nom'] = $employe['NOM'];
$_SESSION['prenom'] = $employe['PRENOM'];
$_SESSION['mail'] = $employe['MAIL'];
$_SESSION['tel'] = $employe['TELEPHONE'];
$_SESSION['service'] = $service['NOM_SERVICE'];


