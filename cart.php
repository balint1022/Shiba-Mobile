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
  <div class="container cart">
    <h2>Kosár</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Termék</th>
          <th>Mennyiség</th>
          <th>Darabár</th>
        </tr>
      </thead>
      <tbody>
        <?php
        session_start();
        require_once ("config.php");

        // A felhasználó azonosítójának lekérése a munkamenetből
        $user_id = $_SESSION['id'];
        
        if (!isset($_SESSION['id'])) {
          // Ha nincs bejelentkevze -> 404.php
          header("Location: 404.php");
          exit; 
        }

        // Az összes ár összege inicializálása 0-val
        $totalPrice = 0;

        // SQL lekérdezés előkészítése és végrehajtása a kosár elemek lekérdezéséhez
        $stmt = $conn->prepare("SELECT kosar.termek_id, termekek.nev, termekek.kep, termekek.ar, kosar.mennyiseg FROM kosar JOIN termekek ON kosar.termek_id = termekek.id WHERE kosar.felhasznalo_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Kosár elemek megjelenítése és az ár összesítése
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nev']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mennyiseg']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ar']) . " FT</td>";
            // Minden sorhoz hozzáadunk egy "törlés" gombot
            echo "<td>";
            echo "<form action='remove_from_cart.php' method='post'>";
            echo "<input type='hidden' name='termek_id' value='" . htmlspecialchars($row['termek_id']) . "'>";
            echo "<button type='submit' class='btn btn-danger'>törlés</button>";
            echo "</form>";
            echo "</td>";
            // Minden sorhoz hozzáadunk egy "mennyiség módosítás" gombot
            echo "<td>";
            echo "<form action='modify_quantity.php' method='post' id='modifyForm" . $row['termek_id'] . "'>";
            echo "<input type='hidden' name='termek_id' value='" . htmlspecialchars($row['termek_id']) . "'>";
            echo "<input type='number' class='quantity' name='mennyiseg' value='" . htmlspecialchars($row['mennyiseg']) . "' min='1' id='quantityInput" . $row['termek_id'] . "'>";
            echo "<button type='button' class='btn btn-primary' onclick='toggleQuantityInput(" . $row['termek_id'] . ")'>módosítás</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";

            // Az ár összesítése
            $totalPrice += $row['ar'] * $row['mennyiseg'];
          }
        } else {
          echo "<tr><td colspan='5'>A kosár üres.</td></tr>";
        }

        // Az összes ár megjelenítése
        echo "<tr>";
        echo "<td colspan='4' class='text-right'><strong>Összesen fizetendő:</strong></td>";
        echo "<td>" . htmlspecialchars($totalPrice) . " FT</td>";
        echo "</tr>";

        // Adatbázis kapcsolat bezárása
        $stmt->close();
        $conn->close();
        ?>



      </tbody>
    </table>

    <div class="text-center">
      <a href="checkout.php" class="button"><button>Folytatás a fizetéshez</button></a>
    </div>
  </div>

  <footer class="fixed-bottom text-center text-lg-start text-white">
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

  <script src="js\modify_amount.js"></script>
</body>

</html>