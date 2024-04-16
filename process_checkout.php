<?php
session_start();
require_once 'config.php';

// Ellenőrzi, hogy a felhasználó be van-e jelentkezve
if (isset($_SESSION['felhasznalo_nev'])) {
 $felhasznalo_nev = $_SESSION['felhasznalo_nev'];
} else {
 // Ha a felhasználó nincs bejelentkezve, átirányítja a bejelentkezési oldalra
 header('Location: login.php');
 exit;
}

// A felhasználó azonosítójának lekérése a munkamenetből
$user_id = $_SESSION['id'];

// Ellenőrzi, hogy a kosár azonosítója elérhető-e a munkamenetben
if (!isset($_SESSION['cart_id'])) {
 // Ha nincs, lekérdezi a kosár azonosítóját az adatbázisból
 $stmt = $conn->prepare("SELECT id FROM kosar WHERE felhasznalo_id = ?");
 $stmt->bind_param("i", $user_id);
 $stmt->execute();
 $result = $stmt->get_result();
 if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['cart_id'] = $row['id'];
 } else {
    // Ha nincs létező kosár, létrehoz egy újat
    $stmt = $conn->prepare("INSERT INTO kosar (felhasznalo_id) VALUES (?)");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $_SESSION['cart_id'] = $conn->insert_id;
 }
 $stmt->close();
}

// A kosár azonosítójának lekérése a munkamenetből
$cart_id = $_SESSION['cart_id'];

// Ellenőrzi, hogy a kérés metódusa POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // Adatok lekérése a POST kérésből
 $nev = $_POST['firstname'];
 $email = $_POST['email'];
 $cim = $_POST['address'];
 $varos = $_POST['city'];
 $orszag = $_POST['state'];
 $zip = $_POST['zip'];

 // SQL lekérdezés előkészítése a rendelési adatok hozzáadásához
 $stmt = $conn->prepare("INSERT INTO `rendelesi_adatok`(`nev`, `email`, `cim`, `varos`, `orszag`, `iranyitoszam`) VALUES (?, ?, ?, ?, ?, ?)");
 $stmt->bind_param("ssssss", $nev, $email, $cim, $varos, $orszag, $zip);
 $stmt->execute();

 // Ellenőrzi, hogy a lekérdezés sikeres volt-e
 if ($stmt->affected_rows > 0) {
    // Ha igen, lekérdezi a rendelés azonosítóját
    $rendeles_id = $conn->insert_id;

    // SQL lekérdezés előkészítése a rendelés hozzáadásához a rendelések táblához
    $stmt = $conn->prepare("INSERT INTO `rendelesek`(`rendeles_id`, `rendelo_id`) VALUES (?, ?)");
    // Lekérdezi a kosár tartalmát
    $stmtKosarTartalma = $conn->prepare("SELECT termek_id FROM kosar WHERE id = ?");
    $stmtKosarTartalma->bind_param("i", $cart_id);
    $stmtKosarTartalma->execute();
    $eredmenyKosar = $stmtKosarTartalma->get_result();

    // Minden termékhez hozzáadja a rendelést a rendelések táblához
    while ($row = $eredmenyKosar->fetch_assoc()) {
      $item_id = $row['termek_id'];
      $stmt->bind_param("ii", $rendeles_id, $user_id); 
      $stmt->execute();
    }

    // Átirányítja a felhasználót a sikeres rendelés oldalra.
    header('Location: success.php');
    exit;
 } else {
    // Ha hiba történt, megjeleníti a hibaüzenetet
    echo "Hiba az adatok eltárolásában. Hiba: " . $stmt->error;
 }

 $stmt->close();
}
?>
