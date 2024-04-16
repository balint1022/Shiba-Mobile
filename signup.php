<?php
require_once "config.php";

$felhasznalo_nev = $jelszo = $jelszo_ok = "";
$felhasznalo_nev_err = $jelszo_err = $jelszo_err_ok = "";

// Ellenőrzi, hogy a kérés metódusa POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Ellenőrzés, hogy elfogadta-e a felhasználó a feltételeket
    if (!isset($_POST['terms'])) {
        // Ha nem fogadta el, akkor egy alert üzenet
        echo '<script language="javascript">';
        echo 'alert("A feltételek elfogadása kötelező!")';
        echo '</script>';
    }

    // Ellenőrzés a felhasznalo_nev inputnak, hogy nem-e üres, nem-e foglalt
    if (empty(trim($_POST['felhasznalo_nev']))) {
        $felhasznalo_nev_err = "A felhasznalónév mező nem lehet üres";
    } else {
        $sql = "SELECT id FROM `felhasznalo` WHERE felhasznalo_nev = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            $param_felhasznalo_nev = trim($_POST['felhasznalo_nev']);
            mysqli_stmt_bind_param($stmt, "s", $param_felhasznalo_nev);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $felhasznalo_nev_err = "Ez a felhasználónév már foglalt.";
                } else {
                    $felhasznalo_nev = trim($_POST['felhasznalo_nev']);
                }
            } else {
                echo "Hiba történt.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Jelszó ellenőrzés
    if (empty(trim($_POST['jelszo']))) {
        $jelszo_err = "A jelszó mező nem lehet üres.";
    } else if (strlen(trim($_POST['jelszo'])) < 8) {
        $jelszo_err = "A jelszó nem lehet kevesebb mint 8 karakter";
    } else {
        $jelszo = trim($_POST['jelszo']);
    }

    // Jelszó megegyezés ellenőrzése
    if (trim($_POST['jelszo']) != trim($_POST['jelszo_megegyszer'])) {
        $jelszo_err = "A jelszók nem egyeznek meg.";
        echo $jelszo_err;
    }

    // Ha nincs hiba, az adatok beillesztése az adatbázisba.
    if (empty($felhasznalo_nev_err) && empty($jelszo_err) && empty($jelszo_err_ok)) {
        $sql = "INSERT INTO felhasznalo(felhasznalo_nev, jelszo) VALUES (?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $param_felhasznalo_nev, $param_jelszo);

            $param_jelszo = password_hash($jelszo, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Hiba történt! Sikertelen továbbítás!";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conn);
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
                <img src="img/Logo.png" alt="Shiba Mobile Logo" id="logo"><a href="signup.php">Shiba Mobile</a>
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
                    <h3>Regisztráció</h3>
                    <label for="felhasznalo_nev">Felhasználónév:</label>
                    <input type="text" placeholder="Pl: felhasznalo_87" id="felhasznalo_nev" name="felhasznalo_nev">
                    <?php if (!empty($felhasznalo_nev_err)): ?>
                        <span class="error">
                            <?php echo $felhasznalo_nev_err; ?>
                        </span>
                    <?php endif; ?>
                    <label for="jelszo">Jelszó:</label>
                    <input type="password" placeholder="********" id="jelszo" name="jelszo">
                    <?php if (!empty($jelszo_err)): ?>
                        <span class="error">
                            <?php echo $jelszo_err; ?>
                        </span>
                    <?php endif; ?>
                    <label for="jelszo_megegyszer">Jelszó megerősítése:</label>
                    <input type="password" placeholder="********" id="jelszo_megegyszer" name="jelszo_megegyszer">
                    <div class="accept">
                        <label for="terms">Elfogadom a <a href="rules.php" target="_blank">feltételeket</a></label>
                        <input type="checkbox" name="terms" id="terms" class="terms">
                    </div>
                    <button type="submit">Regisztráció</button>
                </form>
            </div>
        </div>
    </div>
    <footer class="text-center text-lg-start text-white">
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