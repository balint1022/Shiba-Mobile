<?php

// Adatbázis szerver, felhasználónév, jelszó és adatbázis nevének definiálása
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'shiba');

// Adatbázis kapcsolat létrehozása a megadott paraméterekkel
$conn = mysqli_connect(
    DB_SERVER, // Adatbázis szerver
    DB_USERNAME, // Adatbázis felhasználónév
    DB_PASSWORD, // Adatbázis jelszó
    DB_NAME // Adatbázis neve
);

// Ha a kapcsolat nem sikerül, hibaüzenetet.
if ($conn == false)
    die('Hiba: Csatlakozási hiba');

?>