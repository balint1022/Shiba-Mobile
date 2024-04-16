<?php
// Termék adatainak lekérdezése

require_once("config.php");
// Lekérdezi a termék azonosítóját a `$_GET` változóból, vagy beállítja `0`-ra, ha nincs megadva
$productId = isset($_GET['id']) ? $_GET['id'] : 0;

// Előkészíti az SQL lekérdezést, amely lekérdezi a termék adatait az adatbázisból a megadott azonosító alapján
$stmt = $conn->prepare("SELECT id, nev, kep, ar FROM termekek WHERE id = ?");
$stmt->bind_param("i", $productId);

// Végrehajtja az SQL lekérdezést
$stmt->execute();

// Köti az eredményt a változókhoz
$stmt->bind_result($id, $name, $kepUtvonal, $ar);
// Lekéri az első sor adatait
$stmt->fetch();
$stmt->free_result();
// Bezárja az SQL kapcsolatot
$stmt->close();

?>


<?php

// Termék hozzáadása a kosárhoz
session_start();

if (!isset($_SESSION['id'])) {
  // Ha nincs bejelentkevze -> 404.php
  header("Location: 404.php");
  exit; 
}
// Ellenőrzi, hogy a POST kérés tartalmazza-e a `add_to_cart` paramétert
if (isset($_POST['add_to_cart'])) {
 // Lekéri a termék azonosítóját, mennyiségét és a telefontípus nevét
 $product_id = $_POST['termek_id'];
 $mennyiseg = $_POST['mennyiseg'];
 $user_id = $_SESSION['id'];
 $telefontipus_nev = $_POST['telefontipus'];

 // Lekérdezi a telefontípus azonosítóját az adatbázisból az telefontípus neve alapján
 $stmt = $conn->prepare("SELECT id FROM telefontipus WHERE nev = ?");
 $stmt->bind_param("s", $telefontipus_nev);
 $stmt->execute();
 $result = $stmt->get_result();

 // Ellenőrzi, hogy a telefontípus létezik-e
 if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $telefontipus_id = $row['id'];

    // Ellenőrzi, hogy a termék már szerepel-e a kosárban
    $stmt = $conn->prepare("SELECT * FROM kosar WHERE felhasznalo_id = ? AND termek_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Ha igen, frissíti a mennyiséget, ha nem, hozzáadja a terméket a kosárhoz
    if ($result->num_rows > 0) {
      $stmt->close(); 
      $stmt = $conn->prepare("UPDATE kosar SET mennyiseg = mennyiseg + ? WHERE felhasznalo_id = ? AND termek_id = ?");
      $stmt->bind_param("iii", $mennyiseg, $user_id, $product_id);
    } else {
      $stmt->close(); 
      $stmt = $conn->prepare("INSERT INTO kosar (felhasznalo_id, termek_id, mennyiseg, telefontipus_id) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("iiii", $user_id, $product_id, $mennyiseg, $telefontipus_id);
    }

    // Végrehajtja az SQL lekérdezést
    if ($stmt->execute()) {
      echo "Termék a kosárhoz adva.";
    } else {
      echo "Hiba a termék kosárhoz adása közben.";
    }

    // Bezárja az SQL kapcsolatot
    $stmt->close();
 } else {
    echo "Hiba a telefontípus azonosítása közben.";
 }
}

// Lekérdezi az összes telefontípus nevét az adatbázisból
$sql = "SELECT nev FROM telefontipus";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="hu" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/details.css">
  <title>Shiba Mobile</title>
</head>

<body>
  <br><br>
  <header class="navigation-header">
    <nav>
      <div class="logo-container navigation-items">
        <img src="img/Logo.png" alt="Shiba Mobile Logo" id="logo"><a href="index.php">Shiba Mobile</a>
      </div>
      <div class="navigation-items" id="navigation-items">
        <a href="products.php">Termékek</a>
        <a href="about.php">Rólunk</a>
        <a href="cart.php">Kosár</a>
        <a href="logout.php">Kijelentkezés</a>
        <div class="hamburger">
          <span id="closeHam">&#x2716;</span>
        </div>
      </div>
      <div class="hamburger">
        <span id="openHam">&#9776;</span>
      </div>
    </nav>
  </header>
  <br><br>
  <section class="section product-detail">
    <div class="details container">
      <div class="left image-container">
        <div class="main">
          <img src="<?php echo htmlspecialchars($kepUtvonal); ?>" alt="<?php echo htmlspecialchars($name); ?>">
        </div>
      </div>
      <div class="right">
        <span>SHIBA TOKOK</span>
        <h1 class="my-4">
          <?php echo htmlspecialchars($name); ?>
        </h1>
        <div class="ar">
          <?php echo htmlspecialchars($ar); ?> FT
        </div>

        <form class="form" method="post">
          <input type="hidden" name="termek_id" value="<?php echo htmlspecialchars($productId); ?>">
          <?php
          if ($result->num_rows > 0) {
            echo '<select name="telefontipus">';
            while ($row = $result->fetch_assoc()) {
              echo '<option value="' . htmlspecialchars($row['nev']) . '">' . htmlspecialchars($row['nev']) . '</option>';
            }
            echo '</select>';
            echo '<br>';
          } else {
            echo "No telefontipus found.";
          }
          $result->close();
          ?>
          <input type="number" name="mennyiseg" placeholder="1" min="1" required class="wider-input">
          <input type="submit" name="add_to_cart" value="Kosárhoz adom" class="addCart">
        </form>
        <h3>Termékleírás</h3>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero minima
          delectus nulla voluptates nesciunt quidem laudantium, quisquam
          voluptas facilis dicta in explicabo, laboriosam ipsam suscipit!
        </p>
      </div>
    </div>
  </section>


  <footer class="text-center text-lg-start text-white">
    <div class="container p-4 pb-0">
      <section class="mb-4 text-center icon">
        <h5>Elérhetőségek:</h5>
        <i class="fa">&#xf09a;</i>
        <i class="fa">&#xf081;</i>
        <i class="fa">&#xf16d;</i>
      </section>
      <div class="text-center p-3">
        &copy; Shiba Mobile
      </div>
  </footer>
  <script type="module" src="js/case.js"></script>
  <script src="js/script.js"></script>
</body>

</html>
