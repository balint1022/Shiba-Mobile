<?php
session_start();
require_once("config.php");
if (!isset($_SESSION['id'])) {
    header("Location: 404.php");
    exit;
}

// Ellenőrzi, hogy a termék azonosító és a mennyiség értékek elérhetők-e a POST kérésből
if (isset($_POST['termek_id']) && isset($_POST['mennyiseg'])) {
    $termek_id = $_POST['termek_id'];
    $mennyiseg = $_POST['mennyiseg'];
    $user_id = $_SESSION['id'];

    // SQL lekérdezés előkészítése a termék mennyiségének frissítéséhez a kosárban
    $stmt = $conn->prepare("UPDATE kosar SET mennyiseg = ? WHERE felhasznalo_id = ? AND termek_id = ?");
    // Paraméterek kötése az SQL lekérdezéshez
    $stmt->bind_param("iii", $mennyiseg, $user_id, $termek_id);
    // Végrehajtja az SQL lekérdezést
    $stmt->execute();

    // Átirányítja a felhasználót a kosár oldalra
    header("Location: cart.php");
    exit; 
}
?>
