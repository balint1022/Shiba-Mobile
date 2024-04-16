<!DOCTYPE html>
<html lang="hu" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/success.css">
    <link rel="stylesheet" href="css/style.css">

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
    <main>
        <div class="container">
            <?php
          include_once ("config.php");
            session_start();
          $user_id = $_SESSION['id'];

          if (!isset($_SESSION['id'])) {
              header("Location: 404.php");
              exit;
          }
            // A felhasználó azonosítójának lekérése a munkamenetből
            
            
            // SQL lekérdezés előkészítése a felhasználó rendeléseinek lekérdezéséhez
            $stmt = $conn->prepare("SELECT rendelesek.id AS rendeles_id, 
                                    rendelesek.rendelo_id, 
                                    rendelesi_adatok.id AS rendelesi_adatok_id, 
                                    rendelesi_adatok.nev AS rendelo_neve, 
                                    kosar.termek_id, 
                                    termekek.nev AS termekek_nev, 
                                    kosar.mennyiseg AS kosar_mennyiseg, 
                                    rendelesi_adatok.rendeles_datum AS datum,
                                    telefontipus.nev AS telefontipus_nev
                                    FROM rendelesek 
                                    JOIN rendelesi_adatok ON rendelesek.rendeles_id = rendelesi_adatok.id
                                    JOIN kosar ON rendelesek.rendelo_id = kosar.felhasznalo_id
                                    JOIN termekek ON kosar.termek_id = termekek.id
                                    JOIN telefontipus ON kosar.telefontipus_id = telefontipus.id
                                    WHERE rendelesek.rendelo_id = ?;
                                    ");

            // Paraméter kötése az SQL lekérdezéshez
            $stmt->bind_param("i", $user_id);

            // Végrehajtja az SQL lekérdezést
            $stmt->execute();

            // Lekéri az eredményt
            $result = $stmt->get_result();

            // Bezárja az SQL kapcsolatot
            $stmt->close();

            // Ellenőrzi, hogy vannak-e rendelések
            if ($result->num_rows > 0) {
                // Kiírja a felhasználó nevét és a rendelések listáját
                echo "<h2 class='text-center'> " . htmlspecialchars($_SESSION['felhasznalo_nev']) . " felhasználó által vásárolt termék(ek):</h2>";
                echo "<table border='1' class='col-lg-12'>";
                echo "<tr><th>Rendelés Azonosító </th><th>Termék Azonosító: </th><th>Termék Neve: </th><th>Telefontípus: </th><th>Mennyiség: </th> </th><th>Rendelés időpontja: </th></tr>";

                // Kiírja a rendelések adatait
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['rendeles_id'] . "</td>";
                    echo "<td>" . $row['termek_id'] . "</td>";
                    echo "<td>" . $row['termekek_nev'] . "</td>";
                    echo "<td>" . $row['telefontipus_nev'] . "</td>";
                    echo "<td>" . $row['kosar_mennyiseg'] . "</td>";
                    echo "<td>" . $row['datum'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                // Ha nincsenek rendelések
                echo "A felhasználó nem rendelkezik rendeléssel.";
            }
            ?>

    </main>
    </div>
    <br><br>
    <footer class="fixed-bottom text-center text-lg-start text-white">
        <div class="container p-4 pb-0">
            <section class="mb-4 text-center icon">
                <h5>Elérhetőségek:</h5>
                <i class="fa">&#xf09a;</i>
                <i class="fa">&#xf081;</i>
                <i class="fa">&#xf16d;</i>
            </section>
        </div>
        <div class="text-center p-3">
            &copy; Shiba Mobile
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>

</html>