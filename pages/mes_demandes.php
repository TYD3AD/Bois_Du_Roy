<?php
$title = 'Mes demandes en cours';
include('../common/header.php');
include('../models/session.php');
?>

<div class="div_demande">
  <table class="tab_demandes">
    <tr>
      <th class="tab_nom tab_demandes_index">N°</th>
      <th class="tab_nom tab_demandes_dates">Début</th>
      <th class="tab_nom tab_demandes_dates">Fin</th>
      <th class="tab_nom tab_demandes_motif">Motif</th>
      <th class="tab_nom tab_demandes_btn">Modifier</th>
      <th class="tab_nom tab_demandes_btn">Supprimer</th>
    </tr>

    <?php
    include('../models/req_demandes_en_cours.php');
    $n = 1;



    foreach ($demandes as $value) {
      echo '<tr>';
      echo  '<td class="tab_index">' . $n . '</td>';
      echo  '<td class="tab_dates">' . $value['DATE_DEBUT'] . '</td>';
      echo  '<td class="tab_dates">' . $value['DATE_FIN'] . '</td>';
      echo  '<td class="tab_motif">' . $value['MOTIF_DEMANDE'] . '</td>';
      //bouton edition qui renvoie vers la page de modification
      echo '<td class="tab_demandes_btn"><a href="edition_demande.php?id=' . $value['ID_DEMANDE_CONGE'] . '"><img class="tab_img_btn" src="../publics/img/btn_edit.svg"></a></td>';

      //bouton suppression qui renvoie vers la page de suppression
      echo '<td class="tab_demandes_btn">
                <form method="post" action="">
                  <button type="submit" name="supprimer" style="border: none; background: none;">
                    <img class="tab_img_btn" src="../publics/img/btn_delete.svg" alt="Supprimer">
                  </button>
                </form>
              </td>';
      echo '</tr>';
      $n++;
    }
    // si le bouton suppression est cliqué, on supprime la demande
    if (isset($_POST['supprimer'])) {
      include('../models/req_suppression_demande.php?id=' . $value["ID_DEMANDE_CONGE"] . '');
      header('Location: ../models/req_suppression_demande.php?id=' . $value["ID_DEMANDE_CONGE"] . '');
    }



    ?>
  </table>
  <?php
  require('../common/footer.php');
  ?>