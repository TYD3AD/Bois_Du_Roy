<?php
            function Refus($id, $motif)
            {

                $id_Refus = $id;
                // met à jour la demande en "Refusé"
                include '../models/connexion_serveur.php';
                $matricule = $_SESSION['matricule'];
                $sql = "UPDATE DEMANDE_CONGE SET STATUT_DEMANDE_CONGE = 3, VALIDATEUR = :matricule, MOTIF_DECISION = :motif WHERE ID_DEMANDE_CONGE = :id";
                $query = $db->prepare($sql);
                $query->bindValue(':id', $id_Refus, PDO::PARAM_STR);
                $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
                $query->bindValue(':motif', $motif, PDO::PARAM_STR);
                $query->execute();


                // récupère le nombre de jours de congés demandés
                $sql = "SELECT DATEDIFF(DATE_FIN, DATE_DEBUT) AS NB_Jours, TYPE_CONGE_DEMANDE, MATRICULE FROM DEMANDE_CONGE WHERE ID_DEMANDE_CONGE = :id";
                $query = $db->prepare($sql);
                $query->bindValue(':id', $id_Refus, PDO::PARAM_STR);
                $query->execute();
                $conge = $query->fetch();
                $nbJours = $conge['NB_Jours'];
                $typeConge = $conge['TYPE_CONGE_DEMANDE'];
                $matricule_employe = $conge['MATRICULE'];


                // récupère le solde de congés restant du salarié concerné
                $sql = "SELECT CONGE_RESTANT FROM CONGE WHERE MATRICULE = :matricule AND ID_TYPE_CONGE = :typeConge";
                $query = $db->prepare($sql);
                $query->bindValue(':matricule', $matricule_employe, PDO::PARAM_STR);
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
                $query->bindValue(':matricule', $matricule_employe, PDO::PARAM_STR);
                $query->bindValue(':typeConge', $typeConge, PDO::PARAM_STR);
                $query->execute();

                header('Refresh:1; Location: ../pages/gestion_demande.php');
            }



            // fonction qui affiche la popup de refus
            function popUpRefus($id)
            {
                echo '<div id="popupRefus_' . $id . '" class="popup">';
                echo '<div class="popup-content">';
                echo '<form method="post" action="">';
                echo '<textarea name="Motif" id="Motif_popUp_' . $id . '" cols="30" rows="10" class="motif_popUp" placeholder="motif de refus pour la demande '. $id. '" required></textarea>';
                echo '<div class="btn_popUp">';
                echo '<button type="button" class="close" onclick="closePopUpRefus('.$id.')">Annuler</button>';
                echo '<input type="submit" name="Refus_popUp_' . $id . '" value="Refuser"></input>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }

            //convertit la date en format français
            function convertDate($date)
            {
                $date = explode('-', $date);
                $date = $date[2] . '/' . $date[1] . '/' . $date[0];
                return $date;
            }

            // fonction qui valide la demande
            function Valider($id)
            {
                // met à jour la demande en "Validé"
                include '../models/connexion_serveur.php';
                $matricule = $_SESSION['matricule'];
                $sql = "UPDATE DEMANDE_CONGE SET STATUT_DEMANDE_CONGE = 2, VALIDATEUR = :matricule WHERE ID_DEMANDE_CONGE = :id";
                $query = $db->prepare($sql);
                $query->bindValue(':id', $id, PDO::PARAM_STR);
                $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
                $query->execute();
                header('Refresh:0');
            }
