<?php

session_start();

// Törli a munkamenetben tárolt összes adatot
$_SESSION = array();

// Törli a munkamenetet
session_destroy();

// Átirányítja a felhasználót a bejelentkezési oldalra
header("location: login.php");
?>
