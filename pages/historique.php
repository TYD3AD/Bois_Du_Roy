<?php
$title = 'Historique des demandes';
include('../common/header.php');
require('../models/req_histo.php');
?>


<div class="historique_tab">
  <table class="tab_histo">
    <tr>
      <th class="tab_nom">N°</th>
      <th class="tab_nom">Début</th>
      <th class="tab_nom">Fin</th>
      <th class="tab_nom">Motif</th>
      <th class="tab_nom">Etat de la demande</th>
      <th class="tab_nom">Raison</th>
      <th class="tab_nom">Validateur</th>
    </tr>

    <?php
    $n = 1;

    foreach ($histo as $value) {
      echo '<tr>';
      echo '<td class="tab_index">' . $n . '</td>';
      echo '<td class="tab_dates">' . $value['DATE_DEBUT'] . '</td>';
      echo '<td class="tab_dates">' . $value['DATE_FIN'] . '</td>';
      echo '<td class="tab_motif">' . $value['MOTIF_DEMANDE'] . '</td>';
      echo '<td class="tab_histo_statut">' . $value['LIBELLE_STATUT'] . '</td>';
      echo '<td class="tab_histo_decision">' . $value['MOTIF_DECISION'] . '</td>';
      echo '<td class="tab_histo_validateur">' . $value['VALIDATEUR'] . '</td>';
      $n++;
    }



    ?>
  </table>


</div>
<?php require('../common/footer.php'); ?>