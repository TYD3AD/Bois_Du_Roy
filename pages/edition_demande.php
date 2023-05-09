<?php
$id = $_GET['id'];
$title = 'Edition de la demande ' . $id;
include('../common/header.php');
?>

<div class="soldes">
    <?php
    include('../models/req_solde.php');
    ?>
</div>

<div class="edition_demande_form">
    <?php include('../models/req_edition.php'); ?>
</div>