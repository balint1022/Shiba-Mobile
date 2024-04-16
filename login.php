<?php
session_start();

// Ellenőrzi, hogy a felhasználó már be van-e jelentkezve
if (isset($_SESSION['felhasznalo_nev'])) {
    // Ha a felhasználó már be van jelentkezve, átirányítja az index oldalra
    header("location: index.php");
    exit; // Leállítja a script futását
}

// Konfigurációs fájl betöltése
require_once "config.php";

// Változók inicializálása
$felhasznalo_nev = $jelszo = "";
$felhasznalo_nev_err = $jelszo_err = "";
$err = "";

// Ellenőrzi, hogy a kérés metódusa POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Ellenőrzi, hogy a felhasználónév és a jelszó mezők nem üresek-e
    if (empty(trim($_POST['felhasznalo_nev'])) || empty(trim($_POST['jelszo']))) {
        $err = "Kérlek add meg a felhasználóneved és a jelszavad!";
    } else {
        $felhasznalo_nev = trim($_POST['felhasznalo_nev']);
        $jelszo = trim($_POST['jelszo']);
    }
    // Ha nincs hiba, akkor folytatja a bejelentkezési folyamatot
    if (empty($err)) {
        // SQL lekérdezés előkészítése a felhasználó adatainak lekérdezéséhez
        $sql = "SELECT `id`, `felhasznalo_nev`, `jelszo` FROM `felhasznalo` WHERE felhasznalo_nev = ?";
        $stmt = mysqli_prepare($conn, $sql);
        $param_felhasznalo_nev = $felhasznalo_nev;
        mysqli_stmt_bind_param($stmt, "s", $param_felhasznalo_nev);

        // Végrehajtja az SQL lekérdezést
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            // Ellenőrzi, hogy létezik-e ilyen felhasználónév
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $felhasznalo_nev, $hashed_jelszo);
                if (mysqli_stmt_fetch($stmt)) {
                    // Ellenőrzi, hogy a jelszó helyes-e
                    if (password_verify($jelszo, $hashed_jelszo)) {
                        // Ha az adatok helyesek, bejelentkezteti a felhasználót
                        session_start();
                        $_SESSION["felhasznalo_nev"] = $felhasznalo_nev;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

                        header("location: index.php"); // Átirányítja az index oldalra
                    } else {
                        $err = "Hibás felhasználónév vagy jelszó, kérlek próbáld újra.";
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hu" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Bejelentkezés</title>
</head>

<body>
    <br><br>
    <header class="navigation-header">
        <nav>
            <div class="logo-container navigation-items">
                <img src="img/Logo.png" alt="Shiba Mobile Logo" id="logo"><a href="login.php">Shiba Mobile</a>
            </div>
            <div class="navigation-items" id="navigation-items">

                <a href="login.php">Bejelentkezés</a>
                <div class="hamburger">
                    <span id="closeHam">&#x2716;</span>

                </div>
            </div>
            <div class="hamburger">
                <span id="openHam">&#9776;</span>
            </div>
        </nav>
    </header>


    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-8">
                <form action="" method="post">
                    <h3>Bejelentkezés</h3>
                    <label for="felhasznalo_nev">Felhasználónév:</label>
                    <input type="text" placeholder="Pl: felhasznalo_78" id="felhasznalo_nev" name="felhasznalo_nev">
                    <label for="jelszo">Jelszó:</label>
                    <input type="password" placeholder="********" id="jelszo" name="jelszo">
                    <span class="error">
                        <?php echo $err; ?>
                    </span>
                    <button>Bejelentkezés</button>
                    <a href="signup.php">Nincs fiókod? Regisztrálj be itt.</a>
                </form>
            </div>
            <!-- itt volt a telefon -->
        </div>
    </div>
    <footer class=" text-center text-lg-start text-white">
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