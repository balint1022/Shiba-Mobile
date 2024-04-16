
<?php
session_start();
require_once ("config.php");

if (!isset($_SESSION['id'])) {
    header("Location: 404.php");
    exit; 
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
    <link rel="stylesheet" href="css/about.css">
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
    <div class="about" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="display-4 text-center typewriter">Shiba Mobile</h2>
                    <p class="text-center lead">Tudj meg többet rólunk.</p>
                </div>
                <div class="canvas_container text-center">
                    <canvas id="canvas3d"></canvas>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-uppercase">Kik vagyunk?</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam omnis ipsum alias est
                            corporis
                            quibusdam autem ut, praesentium voluptatum natus esse nihil. Sapiente nihil iure et,
                            accusamus
                            ratione nesciunt soluta? Lorem ipsum dolor sit amet consectetur.</p>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-uppercase">Mi a célja a Shiba Mobile-nak?</h3>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor et mollitia iusto cum,
                            temporibus
                            deserunt, itaque ducimus fuga earum quam eaque ex odit totam. Nobis reprehenderit ipsa hic
                            provident suscipit.</p>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="display-4 text-center typewriter">Gyakran ismételt kérdések</h2>
                        <p class="text-center lead">Ti kérdeztek, mi válaszolunk.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <div class="faq">
                <button class="accordion">
                    Milyen típusú telefonokhoz találok tokokat a Shiba Mobile webshopjában?
                    <i class="fa fa-arrow-down"></i>
                </button>
                <div class="pannel">
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                        saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                        ullam, iure eligendi harum eaque hic corporis debitis porro
                        consectetur voluptate rem officiis architecto.
                    </p>
                </div>
            </div>

            <div class="faq">
                <button class="accordion">
                    Mennyi idő alatt érkezik meg a rendelésem?
                    <i class="fa fa-arrow-down"></i>
                </button>
                <div class="pannel">
                <a href="shipping.php" target="_blank" class="link">Szállítás</a>
                    <p>
                       
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                        saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                        ullam, iure eligendi harum eaque hic corporis debitis porro
                        consectetur voluptate rem officiis architecto.
                    </p>
                </div>
            </div>

            <div class="faq">
                <button class="accordion">
                    Milyen fizetési lehetőségek állnak rendelkezésemre a Shiba Mobile webshopjában?
                    <i class="fa fa-arrow-down"></i>
                </button>
                <div class="pannel">
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                        saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                        ullam, iure eligendi harum eaque hic corporis debitis porro
                        consectetur voluptate rem officiis architecto.
                    </p>

                </div>
            </div>

            <div class="faq">
                <button class="accordion">
                    Miért érdemes a Shiba Mobile webshopjából vásárolni?
                    <i class="fa fa-arrow-down"></i>
                </button>
                <div class="pannel">
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                        saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                        ullam, iure eligendi harum eaque hic corporis debitis porro
                        consectetur voluptate rem officiis architecto.
                    </p>
                </div>
            </div>

            <div class="faq">
                <button class="accordion">
                    Hogyan tudok kapcsolatba lépni a Shiba Mobile ügyfélszolgálatával, ha kérdésem van?
                    <i class="fa fa-arrow-down"></i>
                </button>
                <div class="pannel">
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
                        saepe molestiae distinctio asperiores cupiditate consequuntur dolor
                        ullam, iure eligendi harum eaque hic corporis debitis porro
                        consectetur voluptate rem officiis architecto.
                    </p>
                </div>
            </div>
        </div>

        <br><br>

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

        <script type="module" src="js/dog.js"></script>
        <script src="js/about.js"></script>
        <script src="js/script.js"></script>
</body>

</html>