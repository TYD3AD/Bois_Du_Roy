<?php
session_start();
function suppression()
{
    $id = $_GET['id'];
    $matricule = $_SESSION['matricule'];
    include('connexion_serveur.php');

    // récupère le nombre de jours de congés demandés
    $sql = "SELECT DATEDIFF(DATE_FIN, DATE_DEBUT) AS NB_Jours, TYPE_CONGE_DEMANDE FROM DEMANDE_CONGE WHERE ID_DEMANDE_CONGE = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $conge = $query->fetch();
    $nbJours = $conge['NB_Jours'];
    $typeConge = $conge['TYPE_CONGE_DEMANDE'];

    // récupère le solde de congés restant
    $sql = "SELECT CONGE_RESTANT FROM CONGE WHERE MATRICULE = :matricule AND ID_TYPE_CONGE = :typeConge";
    $query = $db->prepare($sql);
    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $query->bindValue(':typeConge', $typeConge, PDO::PARAM_STR);
    $query->execute();
    $congeRestant = $query->fetch();
    $congeRestant = $congeRestant['CONGE_RESTANT'];

    // ajoute le nombre de jours de congés demandés au solde de congés restant
    $congeRestant = $congeRestant + $nbJours + 1;

    // met à jour le solde de congés restant
    $sql = "UPDATE CONGE SET CONGE_RESTANT = :congeRestant WHERE MATRICULE = :matricule AND ID_TYPE_CONGE = :typeConge";
    $query = $db->prepare($sql);
    $query->bindValue(':congeRestant', $congeRestant, PDO::PARAM_STR);
    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $query->bindValue(':typeConge', $typeConge, PDO::PARAM_STR);
    $query->execute();


    // supprime la demande de congé
    $sql = "DELETE FROM DEMANDE_CONGE WHERE ID_DEMANDE_CONGE = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_STR);
    $query->execute();


    // Si l'employe a encore des demandes en cours
    $sql = "SELECT * FROM DEMANDE_CONGE WHERE MATRICULE = :matricule AND STATUT_DEMANDE_CONGE = 1";
    $query = $db->prepare($sql);
    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();

    // verifie si l'employe a encore des demandes en cours
    if ($result) {
        // renvoie un message de confirmation et redirection vers la page des demandes en cours
        echo 'La demande a bien été supprimée vous allez être redirigé vers la page des demandes en cours.';
        header('Refresh: 2; URL=../pages/mes_demandes.php');
    } else {
        // renvoie un message de confirmation et redirection vers la page d'accueil
        echo 'La demande a bien été supprimée vous allez être redirigé vers la page d\'accueil.';
        header('Refresh: 2; URL=../pages/accueil.php');
    }
}
suppression();
