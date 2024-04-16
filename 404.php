<?php
$x = array(
    "Sajnáljuk, a keresett oldal nem elérhető.",
    "Elnézést, de ez az oldal nem elérhető.",
    "Hoppá! Úgy tűnik, ez az oldal nem létezik."
);
$rndX = $x[array_rand($x)];
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
    <section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <?php echo $rndX; ?>
            </div>
        </div>
    </div>
    </section>


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