<?php

    // vérification des données reçues
    if (!isset($_POST['matricule']) && !isset($_POST['mdp'])){
        //header("Location: ../index.php");
        //Exit();
        echo 'erreur';
    }
    else{
        $matricule = strip_tags($_POST['matricule']);
        $mdp = strip_tags($_POST['mdp']);
        $connexionValide = false;
        // vérification des données reçues
        if (empty($matricule) || empty($mdp)){
            echo "<p>Erreur champs vide</p>";
        }
        else{
            try{
                // connexion à la base de données via connexion_serveur.php
                require 'connexion_serveur.php';
                // requête SQL
                $sql = "SELECT * FROM COMPTE WHERE MATRICULE = :matricule";
                // préparation de la requête
                $query = $db->prepare($sql);
                // liaison des paramètres
                $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
                // exécution de la requête
                $query->execute();
                // récupération des données
                $result = $query->fetch();
                // vérification du mot de passe
                if ($matricule == $result['MATRICULE'] && password_verify($mdp, $result['MOT_DE_PASSE'])){
                    
                    // connexion réussie
                    $connexionValide = true;
                    // création de la session
                    session_start();
                    $_SESSION['matricule'] = $matricule;

                    $path = '../publics/img/employe/';
                    $filename = $path . $matricule;
                                    
                    $extension = ['.jpg', '.jpeg', '.png', '.gif', '.bmp'];
                    $found = false;
                                    
                    foreach ($extension as $ext) {
                        $url = $filename . $ext;
                        
                    
                        $headers = get_headers($url);
                        
                        
                        if (file_exists($url)) {
                            // le fichier existe à l'adresse URL spécifiée
                            $_SESSION['OK'] = "Je suis passé par la";
                            $_SESSION['P_P_path'] = $url;
                            $found = true;
                            break;
                            
                        }
                    }
                    
                    if (!$found) {
                        
                        $default = $path . 'default.jpg';
                    
                        $_SESSION['P_P_path'] = $default;
                        
                    }

                    // requête SQL pour vérifier si responsable
                    $sql = "SELECT EST_RESPONSABLE FROM COMPTE WHERE MATRICULE = :matricule";
                    // préparation de la requête
                    $query = $db->prepare($sql);
                    // liaison des paramètres
                    $query->bindValue(':matricule', $matricule, PDO::PARAM_STR);
                    // exécution de la requête
                    $query->execute();
                    // récupération des données
                    $estResponsable = $query->fetch();
                    // vérification si responsable
                    if ($estResponsable['EST_RESPONSABLE'] == 1){
                        $_SESSION['responsable'] = true;
                    }
                    else{

                        $_SESSION['responsable'] = false;
                    }

                    // Si mot de passe modifié en Back Office
                    if($result['MOT_DE_PASSE_BACK'] == 1){
                        header("Location: ../pages/changement_mdp.php");
                        exit();
                    }
                    else{

                    // redirection vers la page d'accueil
                    header("Location: ../pages/accueil.php");
                    Exit();
                    }
                }
                else{
                    // connexion échouée
                    echo "<p>Erreur de connexion</p>";
                }
            }
            // gestion des erreurs
            catch (PDOException $e){
                echo "Erreur : " . $e->getMessage();
                echo "Le numéro de l'erreur est : ". $e->getCode();
                die();
            }
        }
    }
