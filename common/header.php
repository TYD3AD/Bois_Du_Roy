<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../publics/img/Logo.svg">
    <link rel="stylesheet" href="../publics/css/style.css">
    <title><?php echo $title ?></title>
</head>

<body>
    <header class="header">
        <li class="li_header">
            <a href="accueil.php" class="a_logo_header"><img src="../publics/img/Logo.svg" alt="Logo entreprise" class="logo_header"></a>
            <ul><a href="../pages/demande_conge.php" class="section_header">Demander une absence</a></ul>
            <ul><a href="../pages/mes_demandes.php" class="section_header">Mes demandes en cours</a></ul>
            <ul><a href="../pages/historique.php" class="section_header">Historique des demandes</a></ul>
            <?php
            session_start();



            if ($_SESSION['responsable'] == true) {
                include('../models/req_notif.php');
            ?>
                <ul>
                    <div class="div_gestion">
                        <a href="../pages/gestion_demande.php" class="section_header btn_gestion_demande">Gestion demande congés</a>
                        <?php
                        if ($notification > 0) {
                            echo '<div class="notification">' . $notification . '</div>';
                        }
                        ?>
                    </div>
                </ul>

            <?php
            }
            ?>
            <script src="../publics/js/script.js"></script>
            <button type="" name="" class="a_P_P_header" onclick="compteShow()">
                <img src="<?= $_SESSION['P_P_path'] ?>" alt="Photo_Profile" class="P_P_header">
            </button>
        </li>
    </header>
    <div class="compte" id="compte">
        <a href="../pages/page_profil.php" class="compte_perso">Gestion et information du compte</a>
        <form action="" method="post">
            <button type="submit" name="deconnection">déconnexion</button>
        </form>
    </div>
    <?php
    function destroy()
    {
        session_destroy();
        unset($_SESSION);
        header("Location: ../index.php");
        exit();
    }



    // vérifie si le bouton de déconnexion name="deconnection" est cliqué
    if (isset($_POST['deconnection'])) {
        // appel de la fonction destroy
        destroy();
    }


    ?>