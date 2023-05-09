<?php
$title = "Demande de congé";
include('../common/header.php');
require('../models/session.php');
?>


<main class="demande_main">
    <!-- Formulaire congé -->
    <div class="form_conge">
        <form action="" method="POST">
            <div class="form_conge_dates">
                <div class="champs_dates">
                    <section>
                        <label for="date_debut">Date de début :</label><br>
                        <input type="date" name="date_debut" id="date_debut" required><br>
                    </section>
                    <section>
                        <label for="date_fin">Date de fin :</label><br>
                        <input type="date" name="date_fin" id="date_fin" required>
                    </section>
                </div>
            </div>
            <textarea name="motif" id="motif" cols="30" rows="10" required placeholder="Motif"></textarea>
            <br>
            <div class="radio">
                <section>
                    <input class="btn_form" type="radio" id="radio_CP" name="radio_conge" value="CP" required>
                    <label for="radio_CP">Congés Payés</label>
                </section>
                <section>
                    <input class="btn_form" type="radio" id="radio_RTT" name="radio_conge" value="RTT" required>
                    <label for="radio_RTT">RTT</label>
                </section>

            </div>
            <div class="btn_form_submit">
                <button type="submit" value="Envoyer" name="submit">Envoyer</button>
            </div>
            <div class="print">
                <button type="button" onclick="window.print()">Imprimer</button>
            </div>
            <div class="reponse_submit">
                <?php
                // si le bouton envoyer est cliqué
                if (isset($_POST['submit'])) {
                    include('../models/req_demande_conge.php');
                    // vérifie si un erreur est stockée dans la session
                    if (isset($_SESSION['erreur'])) {
                        echo $_SESSION['erreur'];
                        unset($_SESSION['erreur']);
                    }
                }
                ?>
            </div>
        </form>
    </div>

    <div class="soldes">
        <?php
        include('../models/req_solde.php');
        ?>
    </div>
</main>

<?php require('../common/footer.php'); ?>