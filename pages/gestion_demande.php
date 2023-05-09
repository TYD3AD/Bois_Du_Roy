<?php
$title = "Gestion des demandes";
include '../common/header.php';
include '../models/session.php';
$matricule = $_SESSION['matricule'];
?>
<script src="../publics/js/script.js"></script>
<div class="div_gestion_demande">
    <table class="tab_gestion_demande">
        <tr>
            <th class="tab_nom tab_gestion_demande_index">N°</th>
            <th class="tab_nom tab_gestion_demande_id">ID</th>
            <th class="tab_nom tab_gestion_demande_nom">Nom Employe</th>
            <th class="tab_nom tab_gestion_demande_dates">Date demande</th>
            <th class="tab_nom tab_gestion_demande_dates">Début</th>
            <th class="tab_nom tab_gestion_demande_dates">Fin</th>
            <th class="tab_nom tab_gestion_demande_motif">Motif</th>
            <th class="tab_nom tab_gestion_demande_btn">Valider</th>
            <th class="tab_nom tab_gestion_demande_btn">Refuser</th>
        </tr>
        <?php
        include '../models/req_gestion_demande.php';

        if ($demandes == null) {
            echo '<tr><td colspan="9">Aucune demande en cours</td></tr>';
        } else {

            include '../models/req_refus_demande.php';
            $n = 0;
            foreach ($demandes as $value) {
                echo '<tr>';
                echo '<td>' . ++$n . ' </td>';
                echo '<td>' . $value['ID_DEMANDE_CONGE'] . '</td>';
                echo '<td>' . $value['NOM'] . '</td>';
                echo '<td>' . $value['DATE_DEMANDE'] . ' </td>';
                echo '<td>' . $value['DATE_DEBUT'] . ' </td>';
                echo '<td>' . $value['DATE_FIN'] . '</td>';
                echo '<td>' . $value['MOTIF_DEMANDE'] . '</td>';
                
                // bouton "Valider"
                echo '<td><form method="post" action="">';
                echo '<input type="submit" name="Valider_' . $value['ID_DEMANDE_CONGE'] . '" value="Valider" class="btn_valider">';
                echo '</form></td>';

                // bouton "Refuser"
                echo '<td><form method="post" action="">';
                echo '<input type="submit" name="Refuser_' . $value['ID_DEMANDE_CONGE'] . '" value="Refuser" class="btn_refus" onClick="OpenPopup()">';
                echo '</form></td>';
                echo '</tr>';
                $id = $value['ID_DEMANDE_CONGE'];

                // si le bouton "Valider" est cliqué
                if (isset($_POST['Valider_' . $value['ID_DEMANDE_CONGE'] . ''])) {
                    Valider($id);
                }

                // si le bouton "Refuser" est cliqué
                if (isset($_POST['Refuser_' . $value['ID_DEMANDE_CONGE'] . ''])) {
                    popUpRefus($id);
                }

                // si le bouton "Refuser" de la popup est cliqué appeler la fonction Refus
                if (isset($_POST['Refus_popUp_' . $id])) {
                    $motif = strip_tags($_POST['Motif']);
                    Refus($id, $motif);
                }
            }
        }
        ?>
</div>
<?php require('../common/footer.php'); ?>