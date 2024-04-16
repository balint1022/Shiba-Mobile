<?php
session_start();
require_once("config.php");

// Ellenőrzi, hogy a termék azonosítója elérhető-e a POST kérésből
if (isset($_POST['termek_id'])) {
    $termek_id = $_POST['termek_id'];
    $user_id = $_SESSION['id'];

    // SQL lekérdezés előkészítése a termék eltávolításához a kosárból
    $stmt = $conn->prepare("DELETE FROM kosar WHERE felhasznalo_id = ? AND termek_id = ?");
    // Paraméterek kötése az SQL lekérdezéshez
    $stmt->bind_param("ii", $user_id, $termek_id);
    // Végrehajtja az SQL lekérdezést
    $stmt->execute();

    // Átirányítja a felhasználót a kosár oldalra
    header("Location: cart.php");
    exit; 
}
?>
