<?php

include('../models/connexion_serveur.php');
include('../models/req_gestion_demande.php');

if ($demandes) {
    $notification = count($demandes);
} else {
    $notification = 0;
}
