<?php
$title = "Accueil";
include('../common/header.php');
include('../models/session.php');
?>
<main class="main_accueil">
    <div class="hello_div">
        <h1 class="hello">Bonjour <?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?></h1>
        <h4>Votre matricule est : <?= $_SESSION['matricule'] ?></h4>
    </div>

    <div class="tableau_accueil">
        <section class="soldes">
            <?php include '../models/req_solde.php' ?>
        </section>
        <section class="derniers_conges_demandes">
            <?php include '../models/req_dernier_conge.php' ?>
        </section>
        <section class="historique">
            <?php include '../models/req_histo_accueil.php' ?>
        </section>
    </div>


    <?php require('../common/footer.php'); ?>