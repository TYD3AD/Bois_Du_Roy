<?php

$host = '192.168.61.69';
$dbname = 'bdd_Bois_Du_Roy';
$username = 'serveur';
$password = 'S€Rv3ur';

$db = new PDO('mysql:host='. $host. ';dbname='. $dbname. ';charset=utf8', ''. $username. '', ''. $password.'');
?>
