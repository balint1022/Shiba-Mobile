<?php

session_start();

// Ellenőrzi, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Ha a felhasználó nincs bejelentkezve, átirányítja a bejelentkezési oldalra
    header("location: login.php");
}

 


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
    <link rel="stylesheet" href="css/checkout.css">
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
<br><br><br>
        <div class="roww">
            <div class="ccol-75">
                <div class="ccontainer">
                <form action="process_checkout.php" method="post">
                        <div class="rrow">
                            <div class="ccol-50">
                                <h3>Számlázási cím</h3>
                                <label for="fname"><i class="fa fa-user"></i> Teljes név:</label>
                                <input type="text" id="fname" name="firstname" placeholder="Kiss Béla" required>
                                <label for="email"><i class="fa fa-envelope"></i> Email:</label>
                                <input type="text" id="email" name="email" placeholder="abc@gmail.com" required>
                                <label for="adr"><i class="fa fa-address-card-o"></i> Szállítási cím:</label>
                                <input type="text" id="adr" name="address" required>
                                <label for="city"><i class="fa fa-institution"></i> Város:</label>
                                <input type="text" id="city" name="city" placeholder="Pl: Kaposvár" required>

                                <div class="rrow">
                                    <div class="ccol-50">
                                        <label for="state">Ország:</label>
                                        <input type="text" id="state" name="state" placeholder="Pl: Magyarország" required>
                                    </div>
                                    <div class="ccol-50">
                                        <label for="zip">Irányítószám:</label>
                                        <input type="text" id="zip" name="zip" placeholder="7400" required>
                                    </div>
                                </div>
                            </div>

                            <div class="ccol-50">
                                <h3>Fizetési adatok</h3>
                                <label for="cname">Kártyahordozó neve:</label>
                                <input type="text" id="cname" name="cardname" placeholder="Kiss Béla" required>
                                <label for="ccnum">Kártyaszám:</label>
                                <input type="text" id="ccnum" name="cardnumber" placeholder="XXXX-XXXX-XXXX-XXXX" required>

                                <div class="rrow">
                                    <div class="ccol-50">
                                        <label for="expyear">Lejárati év:</label>
                                        <input type="text" id="expyear" name="expyear" placeholder="2025" required>
                                    </div>
                                    <div class="ccol-50">
                                        <label for="cvv">CVC</label>
                                        <input type="text" id="cvv" name="cvv" placeholder="787" required>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <input type="submit" value="Rendelés megerősítése" class="btn">
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
    <script type="module" src="js/case.js"></script>
    <script src="js/script.js"></script>
</body>

</html>